<p align="center">
    <a href="https://github.com/ui-awesome/html-field" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/121752654?s=200&v=4" height="100px">
    </a>
    <h1 align="center">UI Awesome Field for PHP.</h1>
    <br>
</p>

<p align="center">
    <a href="https://github.com/ui-awesome/html-field/actions/workflows/build.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html-field/actions/workflows/build.yml/badge.svg" alt="PHPUnit">
    </a>
    <a href="https://codecov.io/gh/ui-awesome/html-field" target="_blank">
        <img src="https://codecov.io/gh/ui-awesome/html-field/branch/main/graph/badge.svg?token=MF0XUGVLYC" alt="Codecov">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/ui-awesome/html-field/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fui-awesome%2Fhtml-field%2Fmain" alt="Infection">
    </a>
    <a href="https://github.com/ui-awesome/html-field/actions/workflows/static.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html-field/actions/workflows/static.yml/badge.svg" alt="Psalm">
    </a>
    <a href="https://shepherd.dev/github/ui-awesome/html-field" target="_blank">
        <img src="https://shepherd.dev/github/ui-awesome/html-field/coverage.svg" alt="Psalm Coverage">
    </a>
    <a href="https://github.styleci.io/repos/773914929?branch=main">
        <img src="https://github.styleci.io/repos/773914929/shield?branch=main" alt="Style ci">
    </a>         
</p>

This library provides a way to generate `HTML` code for various types of form fields, including `text`, `text area`,
`selection`, `checkbox`, `radio`, and all input types.

```php
<?php

declare(strict_types=1);

use App\Model\BasicForm;

echo Field::widget(new BasicForm(), 'fruits')
    ->input(
        CheckboxList::widget()
            ->items(
                Checkbox::widget()->label('Apple')->value(1),
                Checkbox::widget()->label('Banana')->value(2),
                Checkbox::widget()->label('Orange')->value(3),
            )
    )
    ->render()
```

## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```shell
composer require --prefer-dist ui-awesome/html-field:^0.1
```

or add

```json
"ui-awesome/html-field": "^0.1"
```

to the require section of your `composer.json` file. 

## Usage

[Check the documentation docs](/docs/README.md) to learn about usage.

## Testing

[Check the documentation testing](/docs/testing.md) to learn about testing.

## Support versions

[![PHP81](https://img.shields.io/badge/PHP-%3E%3D8.1-787CB5)](https://www.php.net/releases/8.1/en.php)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)
