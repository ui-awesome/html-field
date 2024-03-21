<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\File;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\File};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

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
            Field::widget($formModel, 'attachment')->input(File::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

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
            Field::widget($formModel, 'attachment')
                ->errorAttributes(['class' => 'value'])
                ->input(File::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

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
            Field::widget($formModel, 'attachment')->errorClass('value')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')->errorContent('Error')->input(File::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

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
            Field::widget($formModel, 'attachment')->errorTag()->input(File::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'attachment')->errorTag(false)->input(File::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error');

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
            Field::widget($formModel, 'attachment')->errorTag('div')->input(File::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('attachment', 'Error - 1');
        $formModel->addPropertyError('attachment', 'Error - 2');

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
            Field::widget($formModel, 'attachment')->input(File::widget())->showAllErrors()->render()
        );
    }
}
