<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPForge\Support\Assert;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\ConfigForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <input class="custom-class form-control" id="configform-name" name="ConfigForm[name]" type="text">
            </div>
            HTML,
            Field::widget(new ConfigForm(), 'name')->render()
        );
    }
}
