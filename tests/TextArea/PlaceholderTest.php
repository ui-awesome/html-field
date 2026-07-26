<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\TextArea;

/**
 * Unit tests for {@see Field} placeholder rendering with {@see TextArea}.
 */
#[Group('textarea')]
final class PlaceholderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('placeholder')
                ->input(TextArea::tag())
                ->render(),
            "'placeholder' must be serialized.",
        );
    }
}
