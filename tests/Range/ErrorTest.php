<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Range;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Range};

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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Range::widget())->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorAttributes(['class' => 'value'])->input(Range::widget())->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorClass('value')->input(Range::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->errorContent('Error')->input(Range::widget())->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->errorTag()->input(Range::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            Error
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->errorTag(false)
                ->errorContent('Error')
                ->input(Range::widget())
                ->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')
                ->errorTag('span')
                ->input(Range::widget())
                ->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Range::widget())->showAllErrors()->render()
        );
    }
}
