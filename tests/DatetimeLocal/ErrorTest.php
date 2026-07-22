<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\DatetimeLocal;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputDateTimeLocal};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('dateOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(InputDateTimeLocal::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('dateOfBirth')->errorClass('value')->input(InputDateTimeLocal::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->errorContent('Error')
                ->input(InputDateTimeLocal::tag())
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('dateOfBirth')->errorTag(Block::DIV)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->errorTag(false)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->errorTag(Inline::SPAN)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('dateOfBirth', 'Error - 1');
        $formModel->addError('dateOfBirth', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputDateTimeLocal::tag())->showAllErrors()->render()
        );
    }
}
