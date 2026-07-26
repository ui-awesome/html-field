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
 * Unit tests for {@see Field} rendering with {@see TextArea}.
 */
#[Group('textarea')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea class="value" id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->attributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea class="value" id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->class('value')
                ->input(TextArea::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->containerAttributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->containerClass('value')
                ->input(TextArea::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->containerTag(Block::DIV)
                ->input(TextArea::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->containerTag(false)
                ->input(TextArea::tag())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->containerTag(Block::ARTICLE)
                ->input(TextArea::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Content</label>
            <textarea id="value" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->id('value')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->inputContainerTag(Block::ARTICLE)
                ->render(),
            'Input must be wrapped in the given tag.',
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <label for="basicform-content">Content</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="value">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->name('value')
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            Prefix
            </div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
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
            Prefix
            </div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
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
            Prefix
            </div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->render(),
            'Default field markup must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]" value="content">\ncontent\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->value('content')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value.
        $formModel->setValue('content', 'xxxxxxxxxx');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\nxxxxxxxxxx\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->input(TextArea::tag())
                ->render(),
            'Model value must be rendered as content.',
        );

        // null value.
        $formModel->setValue('content', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('content')
                ->input(TextArea::tag())
                ->render(),
            "'null' must yield empty content.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->value(null)
                ->render(),
            "'value' must be omitted.",
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Content</label>
            <textarea name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->id(null)
                ->input(TextArea::tag())
                ->render(),
            "'id' and the label 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('content')
                ->input(TextArea::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
