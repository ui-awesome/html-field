<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputColor;

/**
 * Unit tests for {@see Field} value casting with {@see InputColor}.
 */
#[Group('color')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->input(InputColor::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to 'string' and serialized.",
        );
    }
}
