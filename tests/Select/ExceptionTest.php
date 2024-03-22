<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Select};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Select::class widget value can not be an object.');

        Field::widget(new BasicForm(), 'username')->input(Select::widget())->value(new \stdClass())->render();
    }
}
