<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputUrl;

/**
 * Unit tests for {@see Field} value casting with {@see InputUrl}.
 */
#[Group('url')]
final class ExceptionTest extends TestCase
{
    public function testCastsIntegerValueToString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url" value="1">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('url')
                ->input(InputUrl::tag())
                ->value(1)
                ->render(),
            "'value' must be cast to `string` and serialized.",
        );
    }
}
