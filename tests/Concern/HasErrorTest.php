<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasError;

final class HasErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testClass(): void
    {
        $instance = new class () {
            use HasError;

            public function getErrorClass(): string
            {
                return $this->errorAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getErrorClass());

        $instance = $instance->errorClass('class');

        $this->assertSame('class', $instance->getErrorClass());

        $instance = $instance->errorClass('class-1');

        $this->assertSame('class class-1', $instance->getErrorClass());

        $instance = $instance->errorClass('override-class', true);

        $this->assertSame('override-class', $instance->getErrorClass());
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The error tag must be a non-empty string.');

        $instance = new class () {
            use HasError;
        };

        $instance->errorTag('');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasError;
        };

        $this->assertNotSame($instance, $instance->errorAttributes([]));
        $this->assertNotSame($instance, $instance->errorClass(''));
        $this->assertNotSame($instance, $instance->errorContent(''));
        $this->assertNotSame($instance, $instance->errorTag(false));
        $this->assertNotSame($instance, $instance->showAllErrors());
    }
}
