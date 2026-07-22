<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasError;

final class HasErrorTest extends \PHPUnit\Framework\TestCase
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

        self::assertEmpty($instance->getErrorClass());

        $instance = $instance->errorClass('class');

        self::assertSame('class', $instance->getErrorClass());

        $instance = $instance->errorClass('class-1');

        self::assertSame('class class-1', $instance->getErrorClass());

        $instance = $instance->errorClass('override-class', true);

        self::assertSame('override-class', $instance->getErrorClass());
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasError;
        };

        self::assertNotSame($instance, $instance->errorAttributes([]));
        self::assertNotSame($instance, $instance->errorClass(''));
        self::assertNotSame($instance, $instance->errorContent(''));
        self::assertNotSame($instance, $instance->errorTag(false));
        self::assertNotSame($instance, $instance->showAllErrors());
    }

    public function testRejectsStringTag(): void
    {
        $this->expectException(\TypeError::class);

        $instance = new class {
            use HasError;
        };

        (new \ReflectionMethod($instance, 'errorTag'))->invoke($instance, 'div');
    }
}
