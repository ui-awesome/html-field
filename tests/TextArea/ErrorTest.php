<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\TextArea};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'content')->input(TextArea::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'content')
                ->errorAttributes(['class' => 'value'])
                ->input(TextArea::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'content')->errorClass('value')->input(TextArea::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->errorContent('Error')->input(TextArea::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'content')->errorTag()->input(TextArea::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            Error
            </div>
            HTML,
            Field::widget($formModel, 'content')->errorTag(false)->input(TextArea::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'content')->errorTag('span')->input(TextArea::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('content', 'Error - 1');
        $formModel->addPropertyError('content', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'content')->input(TextArea::widget())->showAllErrors()->render()
        );
    }
}
