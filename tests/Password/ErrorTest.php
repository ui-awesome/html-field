<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputPassword};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->input(InputPassword::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')
                ->errorAttributes(['class' => 'value'])
                ->input(InputPassword::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->errorClass('value')->input(InputPassword::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('password')->errorContent('Error')->input(InputPassword::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->errorTag(Block::DIV)->input(InputPassword::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->errorTag(false)->input(InputPassword::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->errorTag(Inline::SPAN)->input(InputPassword::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('password', 'Error - 1');
        $formModel->addError('password', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->input(InputPassword::tag())->showAllErrors()->render()
        );
    }
}
