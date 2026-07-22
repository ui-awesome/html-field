<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputNumber};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Argument #1 ($value) must be of type');

        Field::tag()->formModel(new BasicForm())->property('amount')->input(InputNumber::tag())->value([])->render();
    }
}
