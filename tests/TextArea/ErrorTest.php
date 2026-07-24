<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\TextArea;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see TextArea}.
 */
#[Group('textarea')]
final class ErrorTest extends TestCase
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->input(TextArea::tag())
                ->render(),
            'Error content must be rendered.',
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->errorAttributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render(),
            "Error 'class' must be serialized.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->errorClass('value')
                ->input(TextArea::tag())
                ->render(),
            "Error 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->errorContent('Error')
                ->input(TextArea::tag())
                ->render(),
            'Error content must be rendered.',
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->errorTag(Block::DIV)
                ->input(TextArea::tag())
                ->render(),
            "Error must render as '<div>'.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->errorTag(false)
                ->input(TextArea::tag())
                ->render(),
            'Error tag must be omitted.',
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->errorTag(Inline::SPAN)
                ->input(TextArea::tag())
                ->render(),
            'Error must render as the given tag.',
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
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->input(TextArea::tag())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
