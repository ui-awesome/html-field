<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Date;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Form\InputDate;

/**
 * Unit tests for {@see Field} value casting with {@see InputDate}.
 */
#[Group('date')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="date" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputDate::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to 'string' and serialized.",
        );
    }
}
