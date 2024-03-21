<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Number};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a numeric or null value. The value is: array.');

        Field::widget(new BasicForm(), 'amount')->input(Number::widget())->value([])->render();
    }
}
