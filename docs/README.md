# HTML field

This library provides a way to generate `HTML` code for various types of form fields, including `text`, `text area`,
`selection`, `checkbox`, `radio`, and all input types.

## Configured fields

`Field::config()` applies application-scoped recipes to every semantic field slot and retains the config for controls
selected later. `Field::control()` creates the requested semantic control through the config factory and applies its
`field.control.<type>` recipe. The `field.label`, `field.input-container.<type>`, and `field.label.<type>` recipes
resolve during rendering against a `ControlLayout` carrier built from the final semantic control type, so replacing a
control cannot retain the previous type's layout and field-local fluent state always overrides themed layout values.

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

| Context                        | Recipe target                               | Typical calls                                                           |
| ------------------------------ | ------------------------------------------- | ----------------------------------------------------------------------- |
| `field`                        | `Field`                                     | `template`, `inputTemplate`, `inputContainerTag`, `inputContainerClass` |
| `field.container`              | `Field`                                     | `containerTag`, `containerAttributes`, `containerClass`                 |
| `field.input-container.<type>` | `ControlLayout` carrier                     | `inputContainerTag`, `inputContainerAttributes`, `inputContainerClass`  |
| `field.label`                  | `ControlLayout` carrier                     | `labelAttributes`, `labelClass`                                         |
| `field.label.<type>`           | `ControlLayout` carrier                     | control-specific `labelAttributes`, `labelClass`                        |
| `field.control.<type>`         | Created form control                        | `attributes`, `class`, and control-specific methods                     |
| `field.control`                | Explicit input configured before `config()` | `attributes`, `class`                                                   |
| `field.hint`                   | `Field`                                     | `hintTag`, `hintAttributes`, `hintClass`                                |
| `field.error`                  | `Field`                                     | `errorTag`, `errorAttributes`, `errorClass`                             |
| `field.prefix`                 | `Field`                                     | `prefixTag`, `prefixAttributes`, `prefixClass`                          |
| `field.suffix`                 | `Field`                                     | `suffixTag`, `suffixAttributes`, `suffixClass`                          |

Themes own these recipes. `html-field` only defines the semantic contexts, so switching from a Bootstrap 5 config to
a Tailwind config does not require a field subclass or package-level mutable state:

```php
use UIAwesome\Html\Core\Config\Config;
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;

$bootstrap5 = new Config(theme: $bootstrap5Theme, factory: new ControlFactory());
$tailwind = new Config(theme: $tailwindTheme, factory: new ControlFactory());

$bootstrap5Field = Field::tag()->config($bootstrap5)->control('email');
$tailwindField = Field::tag()->config($tailwind)->control('email');
```

Calls made after `config()` are local overrides. An explicit input configured before `config()` receives the generic
`field.control` recipe; an input supplied afterward intentionally replaces the themed control.

### Layout precedence

The `field.label`, `field.input-container.<type>`, and `field.label.<type>` recipes are applied to a `ControlLayout`
carrier during rendering, never to the field, and merge under field-local state per attribute key:

- Themed layout resolves from the final semantic control type. Replacing a control rebuilds the carrier and an
  explicit `input()` drops the control-specific recipes, keeping only the generic `field.label` recipe.
- Field-local fluent state wins over themed layout regardless of whether the call happens before or after `config()`.
  A local `labelClass()` replaces a themed label class instead of appending to it, `inputContainerTag(false)`
  suppresses a themed input container, and a local `inputTemplate()` outranks a themed template, which itself outranks
  the template derived from the control type.
- Label text is the exception: the form model label counts as field-local state, so a themed `label()` call only
  renders when the model label resolves to an empty string.
- Layout recipes may only name label, input-container, input-template, and enclosed-by-label methods; in strict mode
  any other call throws `ConfigException`.
- State set through the generic `field` slot, such as `inputContainerClass`, is applied to the field at `config()`
  time and counts as field-local. Configure input-container state either in the `field` slot or in the typed slots,
  not both.

## Form model field configurations

`FormModelInterface::getFieldConfig()` entries are converted into config calls and applied to the form control through
the core config applier in strict mode. Entries are indexed by method name; a bare value becomes a single positional
argument and a list becomes the ordered argument list.

```php
use UIAwesome\FormModel\Attribute\FieldConfig;

final class LoginForm extends BaseFormModel
{
    #[FieldConfig(['class' => ['form-control'], 'maxlength' => 10])]
    public string $email = '';
}
```

The field config is applied when the field renders, against the control the field finally resolves, exactly once per
render. Because the resolved control is what gets configured, `control()` and `input()` may appear anywhere in the
fluent chain: entries valid only on a replacement control, such as `rows` for `TextArea`, are checked against that
replacement and never against the default `text` control.

Strict mode makes typos fail instead of rendering a control that silently ignores them. An entry naming a method the
resolved control does not expose throws `ConfigException` at render time:

```text
Config call 'maxlenght' from recipe 'field-config.email' is not a public instance method for component
'field.control' (UIAwesome\Html\Form\InputText).
```

The recipe name traces the originating property, and the component identifier is the `field.control` slot derived from
the field context, so an error reports exactly which property and which control rejected the call.

`InvalidFieldConfig` is thrown before any call runs when an entry is indexed by a non-string or empty key, or passes
its arguments as an associative array instead of a positional list.

The field derives the control state from the model first and applies the field config last, so entries are explicit
per-property overrides and are never silently discarded. Precedence runs model-derived binding < field fluent state
(`Field::value()`) < field configuration, which means `['value' => 'admin']` outranks both the model value and
`Field::value()`, and the same holds for `id`, `name`, `checked`, and `placeholder`.

Artifacts derived from the control follow its final state: a `['id' => 'custom-id']` entry renders the label as
`for="custom-id"`, and `aria-describedby` keeps pointing at the rendered hint element. Validation state classes are
merged into `class` rather than replacing it, so a configured `class` always survives.

Field configurations target the form control, not the `Field` itself. Configure field-level slots such as `template`
or `containerTag` on the field or through a theme recipe.

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
