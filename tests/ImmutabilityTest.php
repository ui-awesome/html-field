<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\Form\InputText};

final class ImmutabilityTest extends \PHPUnit\Framework\TestCase
{
    public function testInmutability(): void
    {
        $model = new BasicForm();
        $field = Field::tag();

        self::assertNotSame($field, $field->formModel($model));

        $field = $field->formModel($model);

        $configured = $field->property('amount');

        self::assertNotSame($field, $configured);
        self::assertSame('', $field->getProperty());
        self::assertSame('amount', $configured->getProperty());

        self::assertNotSame($configured, $configured->input(InputText::tag()));
    }
}
