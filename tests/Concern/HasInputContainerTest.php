<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasInputContainer;

final class HasInputContainerTest extends \PHPUnit\Framework\TestCase
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

        self::assertEmpty($instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('class');

        self::assertSame('class', $instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('class-1');

        self::assertSame('class class-1', $instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('override-class', true);

        self::assertSame('override-class', $instance->getInputContainerClass());
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasInputContainer;
        };

        self::assertNotSame($instance, $instance->inputContainerAttributes());
        self::assertNotSame($instance, $instance->inputContainerClass(''));
        self::assertNotSame($instance, $instance->inputContainerTag(false));
    }

    public function testRejectsStringTag(): void
    {
        $this->expectException(\TypeError::class);

        $instance = new class {
            use HasInputContainer;
        };

        (new \ReflectionMethod($instance, 'inputContainerTag'))->invoke($instance, 'div');
    }
}
