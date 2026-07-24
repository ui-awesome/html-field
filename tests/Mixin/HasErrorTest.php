<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use TypeError;
use UIAwesome\Html\Field\Mixin\HasError;

use function is_string;

/**
 * Unit tests for the {@see HasError} trait managing error rendering configuration.
 */
#[Group('mixin')]
final class HasErrorTest extends TestCase
{
    public function testClass(): void
    {
        $instance = new class {
            use HasError;

            public function getErrorClass(): string
            {
                $class = $this->errorAttributes['class'] ?? '';

                return is_string($class) ? $class : '';
            }
        };

        self::assertEmpty(
            $instance->getErrorClass(),
            'Default class must be empty.',
        );

        $instance = $instance->errorClass('class');

        self::assertSame(
            'class',
            $instance->getErrorClass(),
            'Class must be set.',
        );

        $instance = $instance->errorClass('class-1');

        self::assertSame(
            'class class-1',
            $instance->getErrorClass(),
            'Class must be appended.',
        );

        $instance = $instance->errorClass('override-class', true);

        self::assertSame(
            'override-class',
            $instance->getErrorClass(),
            'Override must replace the class list.',
        );
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasError;
        };

        self::assertNotSame(
            $instance,
            $instance->errorAttributes([]),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->errorClass(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->errorContent(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->errorTag(false),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->showAllErrors(),
            'A new instance must be returned.',
        );
    }

    public function testThrowTypeErrorForStringTag(): void
    {
        $instance = new class {
            use HasError;
        };

        $reflectionMethod = new ReflectionMethod($instance, 'errorTag');

        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            'class@anonymous(): Argument #1 ($value) must be of type UnitEnum|false, string given',
        );

        $reflectionMethod->invoke($instance, 'div');
    }
}
