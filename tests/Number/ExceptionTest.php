<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use TypeError;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Form\InputNumber;

/**
 * Unit tests for {@see Field} invalid value handling with {@see InputNumber}.
 */
#[Group('number')]
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
            ->property('amount')
            ->input(InputNumber::tag())
            ->value([])
            ->render();
    }
}
