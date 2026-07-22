<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputNumber};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->input(InputNumber::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')
                ->errorAttributes(['class' => 'value'])
                ->input(InputNumber::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->errorClass('value')->input(InputNumber::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('amount')->errorContent('Error')->input(InputNumber::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->errorTag(Block::DIV)->input(InputNumber::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->errorTag(false)->input(InputNumber::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->errorTag(Inline::SPAN)->input(InputNumber::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('amount', 'Error - 1');
        $formModel->addError('amount', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('amount')->input(InputNumber::tag())->showAllErrors()->render()
        );
    }
}
