<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Form\InputText;

/**
 * Unit tests for {@see Field} immutability across configuration methods.
 */
#[Group('field')]
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $model = new BasicForm();

        $field = Field::tag();

        self::assertNotSame(
            $field,
            $field->formModel($model),
            'Form model must yield a new instance.',
        );

        $field = $field->formModel($model);
        $configured = $field->property('amount');

        self::assertNotSame(
            $field,
            $configured,
            'Property must yield a new instance.',
        );
        self::assertSame(
            '',
            $field->getProperty(),
            'Original property must stay empty.',
        );
        self::assertSame(
            'amount',
            $configured->getProperty(),
            'Derived instance must hold the property.',
        );
        self::assertNotSame(
            $configured,
            $configured->input(InputText::tag()),
            'Input must yield a new instance.',
        );
    }
}
