<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;

/**
 * Unit tests for {@see Field} managing the `class` attribute.
 */
#[Group('mixin')]
final class HasClassTest extends TestCase
{
    public function testImmutability(): void
    {
        $instance = Field::tag();

        self::assertNotSame(
            $instance,
            $instance->class(''),
            'A new instance must be returned.',
        );
    }
}
