<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Month};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Month::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(Month::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorClass('value')->input(Month::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->errorContent('Error')->input(Month::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorTag()->input(Month::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorTag(false)->input(Month::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorTag('span')->input(Month::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('monthOfBirth', 'Error - 1');
        $formModel->addPropertyError('monthOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Month::widget())->showAllErrors()->render()
        );
    }
}
