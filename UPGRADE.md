# Upgrade Guide

## 0.1.0

### Field configurations are applied in strict mode

`FormModelInterface::getFieldConfig()` entries are converted into `UIAwesome\Html\Core\Config\Call` objects and applied
to the form control through `UIAwesome\Html\Core\Config\ConfigApplier` in strict mode.

An entry naming a method the control does not expose now throws `UIAwesome\Html\Core\Exception\ConfigException`
instead of being skipped silently. Typos surface at configuration time.

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

```
Config call 'maxlenght' from recipe 'field-config.email' is not a public instance method for component
'field.control' (UIAwesome\Html\Form\InputText).
```

Fix the method name, or move the entry to a control that exposes it.

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

Entries naming methods both `Field` and the control expose, such as `class`, keep rendering identical markup: the
field transfers its attributes to the control before rendering.

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
