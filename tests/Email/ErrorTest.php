<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputEmail};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error');

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
            Field::tag()->formModel($formModel)->property('email')->input(InputEmail::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error');

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
            Field::tag()->formModel($formModel)->property('email')->errorAttributes(['class' => 'value'])->input(InputEmail::tag())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error');

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
            Field::tag()->formModel($formModel)->property('email')->errorClass('value')->input(InputEmail::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('email')->errorContent('Error')->input(InputEmail::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error');

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
            Field::tag()->formModel($formModel)->property('email')->errorTag(Block::DIV)->input(InputEmail::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('email')->errorTag(false)->input(InputEmail::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('email')->errorTag(Inline::SPAN)->input(InputEmail::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('email', 'Error - 1');
        $formModel->addError('email', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('email')->input(InputEmail::tag())->showAllErrors()->render()
        );
    }
}
