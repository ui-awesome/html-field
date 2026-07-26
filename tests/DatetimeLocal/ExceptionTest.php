<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\DatetimeLocal;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputDateTimeLocal;

/**
 * Unit tests for {@see Field} value casting with {@see InputDateTimeLocal}.
 */
#[Group('datetimelocal')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to `string` and serialized.",
        );
    }
}
