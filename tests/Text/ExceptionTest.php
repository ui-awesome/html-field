<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};

/**
 * Unit tests for {@see Field} value casting with {@see \UIAwesome\Html\Form\InputText}.
 */
#[Group('text')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->value(1)
                ->render(),
            "'value' must be cast to 'string' and serialized.",
        );
    }
}
