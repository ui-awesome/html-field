<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputPassword};

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testIntegerValue(): void
    {
        self::assertStringContainsString(
            'value="1"',
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->value(1)->render(),
        );
    }
}
