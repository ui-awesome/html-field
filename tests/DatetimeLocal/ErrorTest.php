<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\DatetimeLocal;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\DatetimeLocal};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->input(DatetimeLocal::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(DatetimeLocal::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->errorClass('value')->input(DatetimeLocal::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->errorContent('Error')
                ->input(DatetimeLocal::widget())
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->errorTag()->input(DatetimeLocal::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->errorTag(false)->input(DatetimeLocal::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->errorTag('span')->input(DatetimeLocal::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('dateOfBirth', 'Error - 1');
        $formModel->addPropertyError('dateOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->input(DatetimeLocal::widget())->showAllErrors()->render()
        );
    }
}
