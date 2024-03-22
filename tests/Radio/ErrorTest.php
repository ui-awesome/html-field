<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Radio};

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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Radio::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorAttributes(['class' => 'value'])
                ->input(Radio::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->errorClass('value')->input(Radio::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->errorContent('Error')->input(Radio::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->errorTag()->input(Radio::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            Error
            </div>
            HTML,
            Field::widget($formModel, 'agree')->errorTag(false)->input(Radio::widget())->render()
        );
    }

    public function testErrorTagwithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <article>
            Error
            </article>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->errorTag('article')->input(Radio::widget())->render()
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Radio::widget())->showAllErrors()->render()
        );
    }
}
