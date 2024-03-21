<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'username')->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'username')->errorAttributes(['class' => 'value'])->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'username')->errorClass('value')->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->errorContent('Error')->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'username')->errorTag()->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'username')->errorTag(false)->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'username')->errorTag('span')->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('username', 'Error - 1');
        $formModel->addPropertyError('username', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'username')->showAllErrors()->render()
        );
    }
}
