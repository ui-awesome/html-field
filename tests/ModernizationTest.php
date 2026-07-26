<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, InputWidget, UnsupportedTag};
use UIAwesome\Html\Form\{InputCheckbox, InputText};

/**
 * Unit tests for {@see Field} rendering with modernized control and container handling.
 */
#[Group('field')]
final class ModernizationTest extends TestCase
{
    public function testEnclosesANonListControlWithoutUsingListConfiguration(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><control id="basicform-label" name="BasicForm[label]"></label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputWidget::tag())
                ->enclosedByLabel()
                ->render(),
            'Label must enclose the control.',
        );
    }

    public function testRendersEmptyWithoutFormModel(): void
    {
        self::assertSame(
            '',
            Field::tag()
                ->property('amount')
                ->input(InputText::tag())
                ->render(),
            'Output must be empty.',
        );
    }

    public function testRendersEmptyWithoutProperty(): void
    {
        self::assertSame(
            '',
            Field::tag()
                ->formModel(new BasicForm())
                ->input(InputText::tag())
                ->render(),
            'Output must be empty.',
        );
    }

    public function testSetsCheckboxValueWhenTheInputHasNoOptionValue(): void
    {
        $model = new BasicForm();

        $model->setValue('agree', 'yes');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="yes">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('agree')
                ->input(InputCheckbox::tag())
                ->render(),
            "'value' must come from the form model.",
        );
    }

    public function testSetsValueAfterSkippingASourceSetterForANonStringValue(): void
    {
        $model = new BasicForm();
        $model->setValue('image', 10);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <control id="basicform-image" name="BasicForm[image]" value="10">
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('image')
                ->input(InputWidget::tag())
                ->render(),
            "'value' must be cast to `string` and serialized.",
        );
    }

    public function testSkipsUnsupportedUnitEnumContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="text">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerTag(UnsupportedTag::DIV)
                ->render(),
            'Container must be omitted.',
        );
    }
}
