<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Mixin\HasValidateClass;

/**
 * Unit tests for the {@see HasValidateClass} trait managing validation state classes.
 */
#[Group('mixin')]
final class HasValidateClassTest extends TestCase
{
    public function testImmutability(): void
    {
        $instance = new class {
            use HasValidateClass;
        };

        self::assertNotSame(
            $instance,
            $instance->invalidClass(''),
            'A new instance must be returned.',
        );
        self::assertNotSame(
            $instance,
            $instance->validClass(''),
            'A new instance must be returned.',
        );
    }
}
