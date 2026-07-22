<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputMonth};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('monthOfBirth')->input(InputMonth::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('monthOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(InputMonth::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('monthOfBirth')->errorClass('value')->input(InputMonth::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->errorContent('Error')->input(InputMonth::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('monthOfBirth')->errorTag(Block::DIV)->input(InputMonth::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('monthOfBirth')->errorTag(false)->input(InputMonth::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('monthOfBirth')->errorTag(Inline::SPAN)->input(InputMonth::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('monthOfBirth', 'Error - 1');
        $formModel->addError('monthOfBirth', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('monthOfBirth')->input(InputMonth::tag())->showAllErrors()->render()
        );
    }
}
