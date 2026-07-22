<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\CanBeEnclosedByLabel;

final class CanBeEnclosedByLabelTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class {
            use CanBeEnclosedByLabel;

            public function isEnclosedByLabel(): bool
            {
                return $this->enclosedByLabel;
            }
        };

        $configured = $instance->enclosedByLabel();

        self::assertNotSame($instance, $configured);
        self::assertTrue($configured->isEnclosedByLabel());
    }
}
