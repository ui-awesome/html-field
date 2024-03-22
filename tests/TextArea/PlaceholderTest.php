<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\TextArea};

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
            <textarea id="basicform-placeholder" name="BasicForm[placeholder]" placeholder="This is a placeholder."></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'placeholder')->input(TextArea::widget())->render()
        );
    }
}
