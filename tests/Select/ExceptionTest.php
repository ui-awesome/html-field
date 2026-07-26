<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypeError;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Form\Select;
use UIAwesome\Html\Helper\Exception\Message;

/**
 * Unit tests for {@see Field} invalid value handling with the select control.
 */
#[Group('select')]
final class ExceptionTest extends TestCase
{
    public function testThrowInvalidArgumentExceptionForObjectValueWithinArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_SHOULD_BE_ARRAY_SCALAR_NULL_ENUM->getMessage('object'),
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('username')
            ->input(Select::tag())
            ->value([new stdClass()])
            ->render();
    }

    public function testThrowTypeErrorForObjectValue(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            'Argument #1 ($value) must be of type',
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('username')
            ->input(Select::tag())
            ->value(new stdClass())
            ->render();
    }
}
