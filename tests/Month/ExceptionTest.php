<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputMonth;

/**
 * Unit tests for {@see Field} value casting with {@see InputMonth}.
 */
#[Group('month')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('monthOfBirth')
                ->input(InputMonth::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to 'string' and serialized.",
        );
    }
}
