<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Number};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class PlaceholderTest extends \PHPUnit\Framework\TestCase
{
    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-placeholder">Placeholder</label>
            <input id="basicform-placeholder" name="BasicForm[placeholder]" type="number" placeholder="This is a placeholder.">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'placeholder')->input(Number::widget())->render()
        );
    }
}
