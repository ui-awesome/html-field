<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\TextArea};

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
            <label for="basicform-content">Content</label>
            <textarea class="value" id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->attributes(['class' => 'value'])
                ->input(TextArea::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea class="value" id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->class('value')->input(TextArea::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->containerAttributes(['class' => 'value'])
                ->input(TextArea::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->containerClass('value')->input(TextArea::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->containerTag()->input(TextArea::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            HTML,
            Field::widget(new BasicForm(), 'content')->containerTag(false)->input(TextArea::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </article>
            HTML,
            Field::widget(new BasicForm(), 'content')->containerTag('article')->input(TextArea::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Content</label>
            <textarea id="value" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->id('value')->input(TextArea::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->inputContainerTag()->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->inputContainerTag('article')->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <label for="basicform-content">Content</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <textarea id="basicform-content" name="value"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->prefix('Prefix')->render()
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
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
                ->prefix('Prefix')
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
            Prefix
            </div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
                ->prefix('Prefix')
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
            Prefix
            </div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
                ->prefix('Prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')
                ->input(TextArea::widget())
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
            <textarea id="basicform-content" name="BasicForm[content]" value="content">content</textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->value('content')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value.
        $formModel->setPropertyValue('content', 'xxxxxxxxxx');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">xxxxxxxxxx</textarea>
            </div>
            HTML,
            Field::widget($formModel, 'content')->input(TextArea::widget())->render()
        );

        // null value.
        $formModel->setPropertyValue('content', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget($formModel, 'content')->input(TextArea::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Content</label>
            <textarea name="BasicForm[content]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->id(null)->input(TextArea::widget())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'content')->input(TextArea::widget())->name(null)->render()
        );
    }
}
