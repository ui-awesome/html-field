<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Date;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Date};
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: integer.');

        Field::widget(new BasicForm(), 'dateOfBirth')->input(Date::widget())->value(1)->render();
    }
}
