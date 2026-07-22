<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\TextArea};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class PlaceholderTest extends \PHPUnit\Framework\TestCase
{
    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-placeholder">Placeholder</label>
            <textarea id="basicform-placeholder" name="BasicForm[placeholder]" placeholder="This is a placeholder.">\n</textarea>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('placeholder')->input(TextArea::tag())->render()
        );
    }
}
