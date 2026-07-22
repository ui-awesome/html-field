<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Field\Tests\Support\SelectControl};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Select control values cannot be arbitrary objects.');

        Field::tag()->formModel(new BasicForm())->property('username')->input(SelectControl::tag())->value(new \stdClass())->render();
    }
}
