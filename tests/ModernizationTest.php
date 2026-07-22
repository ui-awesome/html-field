<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;
use UIAwesome\Html\Field\Tests\Support\InputWidget;
use UIAwesome\Html\Form\{InputCheckbox, InputText};

enum UnsupportedTag
{
    case DIV;
}

final class ModernizationTest extends \PHPUnit\Framework\TestCase
{
    public function testRendersEmptyWithoutFormModel(): void
    {
        self::assertSame('', Field::tag()->property('amount')->input(InputText::tag())->render());
    }

    public function testRendersEmptyWithoutProperty(): void
    {
        self::assertSame('', Field::tag()->formModel(new BasicForm())->input(InputText::tag())->render());
    }

    public function testSkipsUnsupportedUnitEnumContainerTag(): void
    {
        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('amount')
            ->containerTag(UnsupportedTag::DIV)
            ->render();

        self::assertStringStartsWith('<label', $html);
    }

    public function testSetsCheckboxValueWhenTheInputHasNoOptionValue(): void
    {
        $model = new BasicForm();
        $model->setValue('agree', 'yes');

        $html = Field::tag()
            ->formModel($model)
            ->property('agree')
            ->input(InputCheckbox::tag())
            ->render();

        self::assertStringContainsString('value="yes"', $html);
    }

    public function testSetsValueAfterSkippingASourceSetterForANonStringValue(): void
    {
        $model = new BasicForm();
        $model->setValue('image', 10);

        $html = Field::tag()
            ->formModel($model)
            ->property('image')
            ->input(InputWidget::tag())
            ->render();

        self::assertStringContainsString('value="10"', $html);
    }

    public function testEnclosesANonListControlWithoutUsingListConfiguration(): void
    {
        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('label')
            ->input(InputWidget::tag())
            ->enclosedByLabel()
            ->render();

        self::assertStringContainsString('control', $html);
    }
}
