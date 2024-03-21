<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Time};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->input(Time::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->errorAttributes(['class' => 'value'])->input(Time::widget())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->errorClass('value')->input(Time::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'timeOfBirth')->errorContent('Error')->input(Time::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->errorTag()->input(Time::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->errorTag(false)->input(Time::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->errorTag('span')->input(Time::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('timeOfBirth', 'Error - 1');
        $formModel->addPropertyError('timeOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->input(Time::widget())->showAllErrors()->render()
        );
    }
}
