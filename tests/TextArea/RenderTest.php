<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\TextArea};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class RenderTest extends \PHPUnit\Framework\TestCase
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->attributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->class('value')->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->containerAttributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->containerClass('value')->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->containerTag(Block::DIV)->input(TextArea::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('content')->containerTag(false)->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->containerTag(Block::ARTICLE)->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->id('value')->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->inputContainerClass('value')
                ->inputContainerTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->inputContainerTag(Block::DIV)->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->inputContainerTag(false)->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->inputContainerTag(Block::ARTICLE)->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->name('value')->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->prefix('Prefix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
                ->prefixClass('value')
                ->prefixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->prefix('Prefix')
                ->prefixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')
                ->input(TextArea::tag())
                ->template('<div>\n{field}\n</div>')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->value('content')->render()
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
            Field::tag()->formModel($formModel)->property('content')->input(TextArea::tag())->render()
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
            Field::tag()->formModel($formModel)->property('content')->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->value(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->id(null)->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('content')->input(TextArea::tag())->name(null)->render()
        );
    }
}
