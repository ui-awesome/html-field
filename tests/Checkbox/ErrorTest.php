<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Checkbox};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

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
            Field::widget($formModel, 'agree')->input(Checkbox::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

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
            Field::widget($formModel, 'agree')
                ->errorAttributes(['class' => 'value'])
                ->input(Checkbox::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

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
            Field::widget($formModel, 'agree')->errorClass('value')->input(Checkbox::widget())->render()
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
            Field::widget(new BasicForm(), 'agree')->errorContent('Error')->input(Checkbox::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->errorTag('span')->input(Checkbox::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error - 1');
        $formModel->addPropertyError('agree', 'Error - 2');

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
            Field::widget($formModel, 'agree')->input(Checkbox::widget())->showAllErrors()->render()
        );
    }
}
