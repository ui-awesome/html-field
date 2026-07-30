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
