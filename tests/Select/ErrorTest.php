<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Select};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->errorAttributes(['class' => 'value'])
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->errorClass('value')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->errorContent('Error')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->errorTag()->input(Select::widget()->items([1 => 'Apple']))->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            Error
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->errorTag(false)
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->errorTag('span')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error - 1');
        $formModel->addPropertyError('fruits', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->showAllErrors()
                ->render()
        );
    }
}
