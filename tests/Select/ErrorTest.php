<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Field\Tests\Support\SelectControl};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')->input(SelectControl::tag()->items([1 => 'Apple']))->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorAttributes(['class' => 'value'])
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorClass('value')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
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
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->errorContent('Error')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')->errorTag(Block::DIV)->input(SelectControl::tag()->items([1 => 'Apple']))->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(false)
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

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
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(Inline::SPAN)
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error - 1');
        $formModel->addError('fruits', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->showAllErrors()
                ->render()
        );
    }
}
