<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\File;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} error rendering with {@see InputFile}.
 */
#[Group('file')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->input(InputFile::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->errorAttributes(['class' => 'value'])
                ->input(InputFile::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->errorClass('value')
                ->input(InputFile::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->errorContent('Error')
                ->input(InputFile::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->errorTag(Block::DIV)
                ->input(InputFile::tag())
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->errorTag(false)
                ->input(InputFile::tag())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->errorTag(Block::DIV)
                ->input(InputFile::tag())
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('attachment', 'Error - 1');
        $formModel->addError('attachment', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->input(InputFile::tag())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
