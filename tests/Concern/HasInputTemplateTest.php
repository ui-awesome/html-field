<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Concern;

use UIAwesome\Html\Field\Concern\HasInputTemplate;

final class HasInputTemplateTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasInputTemplate;
        };

        $this->assertNotSame($instance, $instance->inputTemplate(''));
    }
}
