<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Image};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

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
            Field::widget($formModel, 'image')->input(Image::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

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
            Field::widget($formModel, 'image')->errorAttributes(['class' => 'value'])->input(Image::widget())->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

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
            Field::widget($formModel, 'image')->errorClass('value')->input(Image::widget())->render()
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
            Field::widget(new BasicForm(), 'image')->errorContent('Error')->input(Image::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

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
            Field::widget($formModel, 'image')->errorTag()->input(Image::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'image')->errorTag(false)->input(Image::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'image')->errorTag('span')->input(Image::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('image', 'Error - 1');
        $formModel->addPropertyError('image', 'Error - 2');

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
            Field::widget($formModel, 'image')->input(Image::widget())->showAllErrors()->render()
        );
    }
}
