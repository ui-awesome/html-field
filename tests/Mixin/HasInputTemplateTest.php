<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Mixin\HasInputTemplate;

/**
 * Unit tests for the {@see HasInputTemplate} trait managing the input template.
 */
#[Group('mixin')]
final class HasInputTemplateTest extends TestCase
{
    public function testImmutability(): void
    {
        $instance = new class {
            use HasInputTemplate;
        };

        self::assertNotSame(
            $instance,
            $instance->inputTemplate(''),
            'A new instance must be returned.',
        );
    }
}
