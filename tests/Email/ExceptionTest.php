<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Email};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: integer.');

        Field::widget(new BasicForm(), 'username')->input(Email::widget())->value(1)->render();
    }
}
