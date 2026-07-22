<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\TextArea};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->input(TextArea::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')
                ->errorAttributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->errorClass('value')->input(TextArea::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('content')->errorContent('Error')->input(TextArea::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->errorTag(Block::DIV)->input(TextArea::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->errorTag(false)->input(TextArea::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->errorTag(Inline::SPAN)->input(TextArea::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('content', 'Error - 1');
        $formModel->addError('content', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('content')->input(TextArea::tag())->showAllErrors()->render()
        );
    }
}
