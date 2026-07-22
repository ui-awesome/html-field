<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputTime};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('timeOfBirth')->input(InputTime::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('timeOfBirth')->errorAttributes(['class' => 'value'])->input(InputTime::tag())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('timeOfBirth')->errorClass('value')->input(InputTime::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->errorContent('Error')->input(InputTime::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('timeOfBirth')->errorTag(Block::DIV)->input(InputTime::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('timeOfBirth')->errorTag(false)->input(InputTime::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('timeOfBirth')->errorTag(Inline::SPAN)->input(InputTime::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('timeOfBirth', 'Error - 1');
        $formModel->addError('timeOfBirth', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('timeOfBirth')->input(InputTime::tag())->showAllErrors()->render()
        );
    }
}
