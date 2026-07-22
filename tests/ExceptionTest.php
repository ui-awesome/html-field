<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\Html\Field\{Exception\AttributeNotSet, Field, Tests\Support\BasicForm};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Form model property "attribute" does not exist.');

        Field::tag()->formModel(new BasicForm())->property('attribute');
    }
}
