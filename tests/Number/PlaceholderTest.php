<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputNumber;

/**
 * Unit tests for {@see Field} placeholder rendering with {@see InputNumber}.
 */
#[Group('number')]
final class PlaceholderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('placeholder')
                ->input(InputNumber::tag())
                ->render(),
            "'placeholder' must be serialized.",
        );
    }
}
