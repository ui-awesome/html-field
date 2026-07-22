<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Field;

final class HasClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = Field::tag();

        self::assertNotSame($instance, $instance->class(''));
    }
}
