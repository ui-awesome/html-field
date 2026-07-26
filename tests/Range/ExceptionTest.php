<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Range;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use TypeError;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Form\InputRange;

/**
 * Unit tests for {@see Field} invalid value handling with {@see InputRange}.
 */
#[Group('range')]
final class ExceptionTest extends TestCase
{
    public function testThrowTypeErrorForArrayValue(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            'Argument #1 ($value) must be of type',
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('monthOfBirth')
            ->input(InputRange::tag())
            ->value([])
            ->render();
    }
}
