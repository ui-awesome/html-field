# Upgrade Guide

## 0.1.0

### Field configurations are applied in strict mode

`FormModelInterface::getFieldConfig()` entries are converted into `UIAwesome\Html\Core\Config\Call` objects and applied
to the form control through `UIAwesome\Html\Core\Config\ConfigApplier` in strict mode.

The field config is applied when the field renders, against the control the field finally resolves, exactly once per
render. Selecting a control with `control()` or `input()` before or after `formModel()` and `property()` produces the
same markup, so the fluent call order never changes the outcome.

An entry naming a method the resolved control does not expose now throws
`UIAwesome\Html\Core\Exception\ConfigException` instead of being skipped silently. Typos surface at render time.

Before, the entry was ignored and the control rendered without it.

```php
public function getFieldConfigs(): array
{
    return [
        'email' => [
            'maxlenght' => 10,
        ],
    ];
}
```

After, the same entry fails with a message naming the call, the recipe, the semantic component, and the control class.

```text
Config call 'maxlenght' from recipe 'field-config.email' is not a public instance method for component
'field.control' (UIAwesome\Html\Form\InputText).
```

Fix the method name, or select a control that exposes it. Entries valid only on a replacement control, such as `rows`
for `TextArea` or `multiple` for `Select`, are checked against the replacement rather than the default `text` control.

```php
echo Field::tag()
    ->formModel($form)
    ->property('biography')
    ->control('textarea')
    ->render();
```

Names with a trailing parenthesis pair, such as `class()`, are not normalized and fail for the same reason. Use the
canonical method name `class`.

### Field configurations target the form control

Field configurations were previously applied twice: once to the `Field` itself and once to the form control. They are
now applied once, to the form control.

Entries naming a method that only `Field` exposes, such as `template` or `containerTag`, must move out of the form
model and onto the field.

Before.

```php
public function getFieldConfigs(): array
{
    return [
        'email' => [
            'template' => ["{label}\n{input}"],
        ],
    ];
}
```

After.

```php
echo Field::tag()
    ->template("{label}\n{input}")
    ->formModel($form)
    ->property('email')
    ->render();
```

Entries naming presentation methods, such as `class` or `maxlength`, render exactly as configured: the field transfers
its attributes to the control before rendering.

### Field configuration overrides the model binding

The field derives the control state from the model first — `value`, `id`, `name`, `checked`, and `placeholder` — and
applies the field config last. Entries are explicit per-property overrides and are never silently discarded.

The precedence chain, lowest to highest:

| Source | Example | Wins over |
| ------ | ------- | --------- |
| Model-derived binding | property value, generated `id` and `name`, `#[Placeholder]` | nothing |
| Field fluent state | `Field::value()` | model-derived |
| Field configuration | `#[FieldConfig(['value' => 'admin'])]` | both |

Verified per key against a `text` control bound to a model that supplies a competing value:

| Entry | Rendered result |
| ----- | --------------- |
| `['id' => 'custom-id']` | `id="custom-id"`, and the label follows with `for="custom-id"` |
| `['name' => 'custom-name']` | `name="custom-name"` instead of the generated `Model[property]` |
| `['value' => 'custom-value']` | `value="custom-value"`, outranking both the model value and `Field::value()` |
| `['placeholder' => 'Custom.']` | `placeholder="Custom."` instead of the model placeholder |
| `['checked' => true]` | `checked` rendered even when the model value would leave the control unchecked |

Artifacts derived from the control follow its final state: the label's `for` reads the control's post-config `id`, and
`aria-describedby` keeps pointing at the rendered hint element.

Because the config is applied after the binding, an entry setting a `checkbox` or `radio` option `value` no longer
takes part in the checked comparison the binding performs. Set `checked` explicitly, or supply the pre-configured
control with `input()`.

### Supported field configuration shapes

Field configurations must be indexed by non-empty method names, and each value must be a bare value or a positional
argument list.

```php
public function getFieldConfigs(): array
{
    return [
        'email' => [
            'class' => ['form-control'],
            'maxlength' => 10,
        ],
    ];
}
```

`UIAwesome\Html\Field\Exception\InvalidFieldConfig` is thrown for the shapes below.

- Entries indexed by a non-string or empty key, such as `[0 => null]`. Integer keys were previously skipped silently.
- Entries passing arguments as an associative array, such as `['class' => ['value' => 'form-control']]`. Config calls
  are positional.
Every entry naming a public method of the resolved control is accepted, including the binding keys, which the config
overrides. The validation state classes are merged into `class` rather than replacing it, so a configured `class`
always survives.
