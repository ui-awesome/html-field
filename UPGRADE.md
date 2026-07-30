# Upgrade Guide

## 0.1.0

### Strict field configuration

Field configuration is applied once, at render time, to the resolved form control. Unknown methods and names with a
trailing parenthesis pair now throw `ConfigException` instead of being ignored.

```php
public function getFieldConfigs(): array
{
    return [
        'email' => [
            'maxlength' => 120,
        ],
    ];
}
```

Configuration is validated against the selected control, so control-specific calls work when that control is selected:

```php
echo Field::tag()
    ->formModel($form)
    ->property('biography')
    ->control('textarea')
    ->render();
```

### Field and control configuration

Entries in `getFieldConfig()` target the form control only. Move field methods such as `template` and `containerTag`
onto the `Field` instance or into a field theme recipe.

```php
echo Field::tag()
    ->template("{label}\n{input}")
    ->formModel($form)
    ->property('email')
    ->render();
```

### Binding precedence

Field configuration overrides field fluent state and model-derived `value`, `id`, `name`, `checked`, and `placeholder`
values. Labels and `aria-describedby` references follow the control's final state.

For checkbox and radio controls, a configured option `value` is applied after the checked comparison. Set `checked`
explicitly when configuration must override the model selection.

### Layout precedence

The `field.label`, `field.input-container.<type>`, and `field.label.<type>` recipes are applied during rendering to a
`ControlLayout` carrier built from the final semantic control type. The carrier merges under field-local state per
attribute key, so fluent calls such as `inputContainerTag(false)`, `labelClass('local', true)`, or `inputTemplate()`
override themed layout values whether they run before or after `config()`.

Layout recipes may only name label, input-container, input-template, and enclosed-by-label methods. In strict mode a
recipe naming any other method throws `ConfigException`; move such calls to the `field` or `field.container` slots.

### Supported shapes

Configuration keys must be non-empty method names. Values may be a single value or a positional argument list:

```php
public function getFieldConfigs(): array
{
    return [
        'email' => [
            'class' => ['form-control'],
            'maxlength' => 120,
        ],
    ];
}
```

Numeric or empty keys and associative argument lists now throw `InvalidFieldConfig`.
