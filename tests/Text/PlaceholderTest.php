<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};

/**
 * Unit tests for {@see Field} placeholder rendering with {@see \UIAwesome\Html\Form\InputText}.
 */
#[Group('text')]
final class PlaceholderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('placeholder')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }
}
