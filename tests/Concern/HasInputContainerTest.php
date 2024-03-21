<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasInputContainer;

final class HasInputContainerTest extends \PHPUnit\Framework\TestCase
{
    public function testClass(): void
    {
        $instance = new class () {
            use HasInputContainer;

            public function getInputContainerClass(): string
            {
                return $this->inputContainerAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('class');

        $this->assertSame('class', $instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('class-1');

        $this->assertSame('class class-1', $instance->getInputContainerClass());

        $instance = $instance->inputContainerClass('override-class', true);

        $this->assertSame('override-class', $instance->getInputContainerClass());
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The input container tag must be a non-empty string.');

        $instance = new class () {
            use HasInputContainer;
        };

        $instance->inputContainerTag('');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasInputContainer;
        };

        $this->assertNotSame($instance, $instance->inputContainerAttributes());
        $this->assertNotSame($instance, $instance->inputContainerClass(''));
        $this->assertNotSame($instance, $instance->inputContainerTag(false));
    }
}
