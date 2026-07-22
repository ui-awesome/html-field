<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasHint;

final class HasHintTest extends \PHPUnit\Framework\TestCase
{
    public function testContent(): void
    {
        $instance = new class {
            use HasHint;

            public function getHintContent(): string
            {
                return $this->hintContent;
            }
        };

        self::assertSame('firstsecond', $instance->hintContent('first', 'second')->getHintContent());
    }

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

        self::assertEmpty($instance->getHintClass());

        $instance = $instance->hintClass('class');

        self::assertSame('class', $instance->getHintClass());

        $instance = $instance->hintClass('class-1');

        self::assertSame('class class-1', $instance->getHintClass());

        $instance = $instance->hintClass('override-class', true);

        self::assertSame('override-class', $instance->getHintClass());
    }

    public function testImmutability(): void
    {
        $instance = new class {
            use HasHint;
        };

        self::assertNotSame($instance, $instance->hintAttributes([]));
        self::assertNotSame($instance, $instance->hintClass(''));
        self::assertNotSame($instance, $instance->hintContent(''));
        self::assertNotSame($instance, $instance->hintId(''));
        self::assertNotSame($instance, $instance->hintTag(false));
    }

    public function testRejectsStringTag(): void
    {
        $this->expectException(\TypeError::class);

        $instance = new class {
            use HasHint;
        };

        (new \ReflectionMethod($instance, 'hintTag'))->invoke($instance, 'div');
    }
}
