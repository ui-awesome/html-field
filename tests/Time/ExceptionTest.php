<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Form\InputTime;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};

/**
 * Unit tests for {@see Field} value casting with {@see InputTime}.
 */
#[Group('time')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('timeOfBirth')
                ->input(InputTime::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to 'string' and serialized.",
        );
    }
}
