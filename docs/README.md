# HTML field

This library provides a way to generate `HTML` code for various types of form fields, including `text`, `text area`,
`selection`, `checkbox`, `radio`, and all input types.

## Semantic control factory

`ControlFactory` creates form controls from semantic component contexts. Its default registry supports `checkbox`,
`email`, `password`, `radio`, `select`, `text`, and `textarea`.

```php
<?php

declare(strict_types=1);

use UIAwesome\Html\Core\Config\ComponentContext;
use UIAwesome\Html\Field\Factory\ControlFactory;

$controlFactory = new ControlFactory();

$control = $controlFactory->create(new ComponentContext('field.control.email'));
```

Use the factory with application-scoped config to create the control and apply the active theme recipes in one step:

```php
use UIAwesome\Html\Core\Config\{ComponentContext, Config};
use UIAwesome\Html\Field\Factory\ControlFactory;

$config = new Config(theme: $theme, factory: new ControlFactory());

$control = $config->create(new ComponentContext('field.control.email'));
```

Registrations are immutable. Derive a new factory to replace a default control or register an external control that
implements `FormControlInterface`:

```php
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Core\Config\ComponentContext;
use UIAwesome\Html\Field\Factory\ControlFactory;

$controlFactory = new ControlFactory();

$factory = $controlFactory->with(
    'editor',
    static fn (ComponentContext $context): FormControlInterface => new EditorControl($context),
);
```
