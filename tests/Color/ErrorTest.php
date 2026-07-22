<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputColor};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->input(InputColor::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->errorAttributes(['class' => 'value'])->input(InputColor::tag())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->errorClass('value')->input(InputColor::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->errorContent('Error')->input(InputColor::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->errorTag(Block::DIV)->input(InputColor::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->errorTag(false)->input(InputColor::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->errorTag(Inline::SPAN)->input(InputColor::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('color', 'Error - 1');
        $formModel->addError('color', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->input(InputColor::tag())->showAllErrors()->render()
        );
    }
}
