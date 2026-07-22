<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputCheckbox};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')
                ->errorAttributes(['class' => 'value'])
                ->input(InputCheckbox::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->errorClass('value')->input(InputCheckbox::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->errorContent('Error')->input(InputCheckbox::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->errorTag(Inline::SPAN)->input(InputCheckbox::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error - 1');
        $formModel->addError('agree', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag())->showAllErrors()->render()
        );
    }
}
