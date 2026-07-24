<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{BasicForm, SelectControl};

/**
 * Unit tests for {@see Field} invalid value handling with the select control.
 */
#[Group('select')]
final class ExceptionTest extends TestCase
{
    public function testThrowInvalidArgumentExceptionForObjectValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Select control values cannot be arbitrary objects.',
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('username')
            ->input(SelectControl::tag())
            ->value(new \stdClass())
            ->render();
    }
}
