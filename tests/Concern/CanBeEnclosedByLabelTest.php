<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\CanBeEnclosedByLabel;

final class CanBeEnclosedByLabelTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeEnclosedByLabel;
        };

        $this->assertNotSame($instance, $instance->enclosedByLabel());
    }
}
