<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use TypeError;
use UIAwesome\Html\Field\Mixin\HasHint;

use function is_string;

/**
 * Unit tests for the {@see HasHint} trait managing hint rendering configuration.
 */
#[Group('mixin')]
final class HasHintTest extends TestCase
{
    public function testClass(): void
    {
        $instance = new class {
            use HasHint;

            public function getHintClass(): string
            {
                $class = $this->hintAttributes['class'] ?? '';

                return is_string($class) ? $class : '';
            }
        };

        self::assertEmpty(
            $instance->getHintClass(),
            'Default class must be empty.',
        );

        $instance = $instance->hintClass('class');

        self::assertSame(
            'class',
            $instance->getHintClass(),
            'Class must be set.',
        );

        $instance = $instance->hintClass('class-1');

        self::assertSame(
            'class class-1',
            $instance->getHintClass(),
            'Class must be appended.',
        );

        $instance = $instance->hintClass('override-class', true);

        self::assertSame(
            'override-class',
            $instance->getHintClass(),
            'Override must replace the class list.',
        );
    }

    public function testContent(): void
    {
        $instance = new class {
            use HasHint;

            public function getHintContent(): string
            {
                return $this->hintContent;
            }
        };

        self::assertSame(
            'firstsecond',
            $instance->hintContent('first', 'second')->getHintContent(),
            'Content parts must be concatenated.',
        );
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasHint;
        };

        self::assertNotSame(
            $instance,
            $instance->hintAttributes([]),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->hintClass(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->hintContent(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->hintId(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->hintTag(false),
            'A new instance must be returned.',
        );
    }

    public function testThrowTypeErrorForStringTag(): void
    {
        $instance = new class {
            use HasHint;
        };

        $reflectionMethod = new ReflectionMethod($instance, 'hintTag');

        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            'class@anonymous(): Argument #1 ($value) must be of type UnitEnum|false, string given',
        );

        $reflectionMethod->invoke($instance, 'div');
    }
}
