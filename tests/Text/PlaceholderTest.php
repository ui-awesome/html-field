<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm};

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
            <input id="basicform-placeholder" name="BasicForm[placeholder]" type="text" placeholder="This is a placeholder.">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'placeholder')->render()
        );
    }
}
