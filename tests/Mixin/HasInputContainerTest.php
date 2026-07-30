<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use TypeError;
use UIAwesome\Html\Field\Mixin\HasInputContainer;
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function is_string;

/**
 * Unit tests for the {@see HasInputContainer} trait managing the input container.
 */
#[Group('mixin')]
final class HasInputContainerTest extends TestCase
{
    public function testClass(): void
    {
        $instance = new class {
            use HasInputContainer;

            public function getInputContainerClass(): string
            {
                $class = $this->inputContainerAttributes['class'] ?? '';

                return is_string($class) ? $class : '';
            }
        };

        self::assertEmpty(
            $instance->getInputContainerClass(),
            'Default class must be empty.',
        );

        $instance = $instance->inputContainerClass('class');

        self::assertSame(
            'class',
            $instance->getInputContainerClass(),
            'Class must be set.',
        );

        $instance = $instance->inputContainerClass('class-1');

        self::assertSame(
            'class class-1',
            $instance->getInputContainerClass(),
            'Class must be appended.',
        );

        $instance = $instance->inputContainerClass('override-class', true);

        self::assertSame(
            'override-class',
            $instance->getInputContainerClass(),
            'Override must replace the class list.',
        );
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasInputContainer;
        };

        self::assertNotSame(
            $instance,
            $instance->inputContainerAttributes(),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->inputContainerClass(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->inputContainerTag(false),
            'A new instance must be returned.',
        );
    }

    public function testTagTracksExplicitValuesAgainstTheNullDefault(): void
    {
        $instance = new class {
            use HasInputContainer;

            public function getInputContainerTag(): false|UnitEnum|null
            {
                return $this->inputContainerTag;
            }
        };

        self::assertNull(
            $instance->getInputContainerTag(),
            'Default must be `null`.',
        );
        self::assertFalse(
            $instance->inputContainerTag(false)->getInputContainerTag(),
            'Explicit `false` must be stored.',
        );
        self::assertSame(
            Block::DIV,
            $instance->inputContainerTag(Block::DIV)->getInputContainerTag(),
            'Enum tag must be stored.',
        );
    }

    public function testThrowTypeErrorForStringTag(): void
    {
        $instance = new class {
            use HasInputContainer;
        };

        $reflectionMethod = new ReflectionMethod($instance, 'inputContainerTag');

        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            'class@anonymous(): Argument #1 ($value) must be of type UnitEnum|false, string given',
        );

        $reflectionMethod->invoke($instance, 'div');
    }
}
