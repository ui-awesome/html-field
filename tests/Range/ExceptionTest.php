<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Range;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Range};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a numeric or null value. The value is: array.');

        Field::widget(new BasicForm(), 'monthOfBirth')->input(Range::widget())->value([])->render();
    }
}
