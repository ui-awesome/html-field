<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasHint;

final class HasHintTest extends \PHPUnit\Framework\TestCase
{
    public function testClass(): void
    {
        $instance = new class () {
            use HasHint;

            public function getHintClass(): string
            {
                return $this->hintAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getHintClass());

        $instance = $instance->hintClass('class');

        $this->assertSame('class', $instance->getHintClass());

        $instance = $instance->hintClass('class-1');

        $this->assertSame('class class-1', $instance->getHintClass());

        $instance = $instance->hintClass('override-class', true);

        $this->assertSame('override-class', $instance->getHintClass());
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The hint tag must be a non-empty string.');

        $instance = new class () {
            use HasHint;
        };

        $instance->hintTag('');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasHint;
        };

        $this->assertNotSame($instance, $instance->hintAttributes([]));
        $this->assertNotSame($instance, $instance->hintClass(''));
        $this->assertNotSame($instance, $instance->hintContent(''));
        $this->assertNotSame($instance, $instance->hintId(''));
        $this->assertNotSame($instance, $instance->hintTag(false));
    }
}
