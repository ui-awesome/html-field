<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

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
            Field::tag()->formModel($formModel)->property('username')->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

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
            Field::tag()->formModel($formModel)->property('username')->errorAttributes(['class' => 'value'])->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

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
            Field::tag()->formModel($formModel)->property('username')->errorClass('value')->render()
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
            Field::tag()->formModel(new BasicForm())->property('username')->errorContent('Error')->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

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
            Field::tag()->formModel($formModel)->property('username')->errorTag(Block::DIV)->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('username')->errorTag(false)->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('username')->errorTag(Inline::SPAN)->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Error - 1');
        $formModel->addError('username', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('username')->showAllErrors()->render()
        );
    }
}
