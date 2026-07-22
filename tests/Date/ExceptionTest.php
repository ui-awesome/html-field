<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Date;

use PHPUnit\Framework\TestCase;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputDate};

final class ExceptionTest extends TestCase
{
    public function testIntegerValue(): void
    {
        self::assertStringContainsString(
            'value="1"',
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDate::tag())->value(1)->render(),
        );
    }
}
