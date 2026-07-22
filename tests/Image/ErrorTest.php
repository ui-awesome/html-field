<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputImage};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->input(InputImage::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->errorAttributes(['class' => 'value'])->input(InputImage::tag())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->errorClass('value')->input(InputImage::tag())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('image')->errorContent('Error')->input(InputImage::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->errorTag(Block::DIV)->input(InputImage::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->errorTag(false)->input(InputImage::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->errorTag(Inline::SPAN)->input(InputImage::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('image', 'Error - 1');
        $formModel->addError('image', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('image')->input(InputImage::tag())->showAllErrors()->render()
        );
    }
}
