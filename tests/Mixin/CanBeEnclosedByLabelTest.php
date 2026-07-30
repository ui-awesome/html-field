<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Mixin\CanBeEnclosedByLabel;

/**
 * Unit tests for the {@see CanBeEnclosedByLabel} trait enclosing the control in its label.
 */
#[Group('mixin')]
final class CanBeEnclosedByLabelTest extends TestCase
{
    public function testImmutability(): void
    {
        $instance = new class {
            use CanBeEnclosedByLabel;

            public function isEnclosedByLabel(): bool|null
            {
                return $this->enclosedByLabel;
            }
        };

        $configured = $instance->enclosedByLabel();

        self::assertNotSame(
            $instance,
            $configured,
            'A new instance must be returned.',
        );
        self::assertTrue(
            $configured->isEnclosedByLabel(),
            'Flag must be enabled on the derived instance.',
        );
    }

    public function testTracksExplicitValuesAgainstTheNullDefault(): void
    {
        $instance = new class {
            use CanBeEnclosedByLabel;

            public function isEnclosedByLabel(): bool|null
            {
                return $this->enclosedByLabel;
            }
        };

        self::assertNull(
            $instance->isEnclosedByLabel(),
            'Default must be `null`.',
        );
        self::assertFalse(
            $instance->enclosedByLabel(false)->isEnclosedByLabel(),
            'Explicit `false` must be stored.',
        );
    }
}
