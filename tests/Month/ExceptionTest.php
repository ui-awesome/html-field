<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputMonth};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testIntegerValue(): void
    {
        self::assertStringContainsString(
            'value="1"',
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputMonth::tag())->value(1)->render(),
        );
    }
}
