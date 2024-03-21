<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Image};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input class="value" id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->attributes(['class' => 'value'])->input(Image::widget())->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input class="value" id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->class('value')->input(Image::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->containerAttributes(['class' => 'value'])
                ->input(Image::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->containerClass('value')->input(Image::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag('div')->input(Image::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="image">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->input(Image::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="image">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag('article')->input(Image::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="id">Image</label>
            <input id="id" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->id('id')->input(Image::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->inputContainerClass('value')
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->inputContainerTag('article')->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <label for="basicform-image">Image</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="name" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->name('name')->input(Image::widget())->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->prefix('Prefix')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            prefix
            </div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->prefix('prefix')
                ->prefixTag('span')
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->suffix('suffix')
                ->suffixTag('span')
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')
                ->input(Image::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image" src="my-file.jpg">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->value('my-file.jpg')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('image', 'my-file.jpg');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image" src="my-file.jpg">
            </div>
            HTML,
            Field::widget($formModel, 'image')->input(Image::widget())->render()
        );

        // empty string value
        $formModel->setPropertyValue('image', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget($formModel, 'image')->input(Image::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('image', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget($formModel, 'image')->input(Image::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Image::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Image</label>
            <input name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'image')->input(Image::widget())->name(null)->render()
        );
    }
}
