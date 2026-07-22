<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Datetime;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputText};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testIntegerValue(): void
    {
        self::assertStringContainsString(
            'value="1"',
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->value(1)
                ->render(),
        );
    }
}
