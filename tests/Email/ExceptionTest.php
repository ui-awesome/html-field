<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputEmail;

/**
 * Unit tests for {@see Field} value casting with {@see InputEmail}.
 */
#[Group('email')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="email" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->input(InputEmail::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to `string` and serialized.",
        );
    }
}
