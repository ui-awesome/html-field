<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputImage};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

/**
 * Unit tests for {@see Field} rendering with {@see InputImage}.
 */
#[Group('image')]
final class RenderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->attributes(['class' => 'value'])
                ->input(InputImage::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->class('value')
                ->input(InputImage::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->containerAttributes(['class' => 'value'])
                ->input(InputImage::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->containerClass('value')
                ->input(InputImage::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::DIV)
                ->input(InputImage::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="image">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->input(InputImage::tag())
                ->render(),
            'Container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::ARTICLE)
                ->input(InputImage::tag())
                ->render(),
            'Container must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->id('id')
                ->input(InputImage::tag())
                ->render(),
            "'id' must propagate to the label 'for' and input.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag(Block::DIV)
                ->render(),
            "Input container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputContainerClass('value')
                ->inputContainerTag(Block::DIV)
                ->render(),
            "Input container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputContainerTag(Block::DIV)
                ->render(),
            'Input must be wrapped in the container tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputContainerTag(false)
                ->render(),
            'Input container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputContainerTag(Block::ARTICLE)
                ->render(),
            'Input container must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render(),
            'Input template must reorder the parts.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->name('name')
                ->input(InputImage::tag())
                ->render(),
            "'name' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('Prefix')
                ->render(),
            'Prefix must precede the input.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            'Prefix tag must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render(),
            'Prefix must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->render(),
            'Default field structure must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the input.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix must render as '<div>'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            'Suffix tag must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Suffix must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->template('<div>\n{field}\n</div>')
                ->render(),
            'Template must wrap the field.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->value('my-file.jpg')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('image', 'my-file.jpg');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image" src="my-file.jpg">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('image')
                ->input(InputImage::tag())
                ->render(),
            "'src' must reflect the model value.",
        );

        // empty string value
        $formModel->setValue('image', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('image')
                ->input(InputImage::tag())
                ->render(),
            "Empty 'string' must omit the 'src' attribute.",
        );

        // null value
        $formModel->setValue('image', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('image')
                ->input(InputImage::tag())
                ->render(),
            "'null' must omit the 'src' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputImage::tag())
                ->value(null)
                ->render(),
            "'null' must omit the 'src' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->id(null)
                ->render(),
            "'null' must omit 'id' and the label 'for'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->input(InputImage::tag())
                ->name(null)
                ->render(),
            "'null' must omit the 'name' attribute.",
        );
    }
}
