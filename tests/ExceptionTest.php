<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\Html\Field\{Exception\AttributeNotSet, Field, Tests\Support\BasicForm};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        Field::widget(new BasicForm(), 'attribute');
    }
}
