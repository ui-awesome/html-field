<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Password};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

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
            Field::widget($formModel, 'password')->input(Password::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

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
            Field::widget($formModel, 'password')
                ->errorAttributes(['class' => 'value'])
                ->input(Password::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

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
            Field::widget($formModel, 'password')->errorClass('value')->input(Password::widget())->render()
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
            Field::widget(new BasicForm(), 'password')->errorContent('Error')->input(Password::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

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
            Field::widget($formModel, 'password')->errorTag()->input(Password::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'password')->errorTag(false)->input(Password::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'password')->errorTag('span')->input(Password::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('password', 'Error - 1');
        $formModel->addPropertyError('password', 'Error - 2');

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
            Field::widget($formModel, 'password')->input(Password::widget())->showAllErrors()->render()
        );
    }
}
