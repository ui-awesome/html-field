# HTML field

This library provides a way to generate `HTML` code for various types of form fields, including `text`, `text area`,
`selection`, `checkbox`, `radio`, and all input types.

## Configured fields

`Field::config()` applies application-scoped recipes to every semantic field slot and retains the config for controls
selected later. `Field::control()` creates the requested semantic control through the config factory and applies its
`field.control.<type>` recipe.

```php
<?php

declare(strict_types=1);

use UIAwesome\Html\Core\Config\Config;
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;

$config = new Config(theme: $theme, factory: new ControlFactory());

echo Field::tag()
    ->config($config)
    ->control('email')
    ->formModel($form)
    ->property('email')
    ->render();
```

The base context defaults to `field`. Its variant, size, scheme, states, and metadata are copied to every derived slot
context.

| Context                | Recipe target                               | Typical calls                                                           |
| ---------------------- | ------------------------------------------- | ----------------------------------------------------------------------- |
| `field`                | `Field`                                     | `template`, `inputTemplate`, `inputContainerTag`, `inputContainerClass` |
| `field.container`      | `Field`                                     | `containerTag`, `containerAttributes`, `containerClass`                 |
| `field.label`          | `Field`                                     | `labelAttributes`, `labelClass`                                         |
| `field.control.<type>` | Created form control                        | `attributes`, `class`, and control-specific methods                     |
| `field.control`        | Explicit input configured before `config()` | `attributes`, `class`                                                   |
| `field.hint`           | `Field`                                     | `hintTag`, `hintAttributes`, `hintClass`                                |
| `field.error`          | `Field`                                     | `errorTag`, `errorAttributes`, `errorClass`                             |
| `field.prefix`         | `Field`                                     | `prefixTag`, `prefixAttributes`, `prefixClass`                          |
| `field.suffix`         | `Field`                                     | `suffixTag`, `suffixAttributes`, `suffixClass`                          |

Themes own these recipes. `html-field` only defines the semantic contexts, so switching from a Flowbite config to a
DaisyUI config does not require a field subclass or package-level mutable state:

```php
use UIAwesome\Html\Core\Config\Config;
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;

$flowbite = new Config(theme: $flowbiteTheme, factory: new ControlFactory());
$daisyUi = new Config(theme: $daisyUiTheme, factory: new ControlFactory());

$flowbiteField = Field::tag()->config($flowbite)->control('email');
$daisyUiField = Field::tag()->config($daisyUi)->control('email');
```

Calls made after `config()` are local overrides. An explicit input configured before `config()` receives the generic
`field.control` recipe; an input supplied afterward intentionally replaces the themed control.

## Semantic control factory

The default registry supports `checkbox`, `checkbox-list`, `email`, `password`, `radio`, `radio-list`, `select`,
`text`, and `textarea`. It can also be used independently:

```php
use UIAwesome\Html\Core\Config\ComponentContext;
use UIAwesome\Html\Field\Factory\ControlFactory;

$control = (new ControlFactory())->create(new ComponentContext('field.control.email'));
```

### Select options

Compose `Select`, `Option`, and `Optgroup` with the typed API from `ui-awesome/html`. `Field` resolves the model value
and delegates option selection to `Select::value()`:

```php
use UIAwesome\Html\Form\{Option, Select};

$select = Select::tag()->options(
    Option::tag()->content('Select a country'),
    Option::tag()->content('Spain')->value('es'),
    Option::tag()->content('United States')->value('us'),
);

echo Field::tag()
    ->config($config)
    ->input($select)
    ->formModel($form)
    ->property('country')
    ->render();
```

Use `Select::multiple(true)` with an array model value for multiple selection. Options nested in an `Optgroup` receive
the same resolved value automatically.

### Choice lists

Checkbox and radio lists and their typed items are reusable controls from `ui-awesome/html`. `Field` supplies model
binding, validation state, the group label, hint, and errors:

```php
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem};

$list = CheckboxList::tag()->items(
    ChoiceItem::tag()->label('Email')->value('email'),
    ChoiceItem::tag()->label('SMS')->value('sms'),
);

echo Field::tag()
    ->config($config)
    ->input($list)
    ->formModel($form)
    ->property('channels')
    ->render();
```

Attributes configured on a choice list belong to its container. Use `itemAttributes()` for attributes that must be
copied to every checkbox or radio input.

Registrations are immutable. Derive a new factory to replace a default control or register an external control that
implements `FormControlInterface`:

```php
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Core\Config\ComponentContext;
use UIAwesome\Html\Field\Factory\ControlFactory;

$controlFactory = new ControlFactory();

$factory = $controlFactory->with(
    'editor',
    static fn (ComponentContext $context): FormControlInterface => EditorControl::tag()
        ->addAttribute('data-component', $context->component),
);
```
