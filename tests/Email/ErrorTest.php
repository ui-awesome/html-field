<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Email};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'email')->input(Email::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'email')->errorAttributes(['class' => 'value'])->input(Email::widget())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'email')->errorClass('value')->input(Email::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')->errorContent('Error')->input(Email::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'email')->errorTag()->input(Email::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')->errorTag(false)->input(Email::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'email')->errorTag('span')->input(Email::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('email', 'Error - 1');
        $formModel->addPropertyError('email', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'email')->input(Email::widget())->showAllErrors()->render()
        );
    }
}
