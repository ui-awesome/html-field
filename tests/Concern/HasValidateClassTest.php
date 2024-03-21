<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasValidateClass;

final class HasValidateClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasValidateClass;
        };

        $this->assertNotSame($instance, $instance->invalidClass(''));
        $this->assertNotSame($instance, $instance->validClass(''));
    }
}
