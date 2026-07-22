<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputUrl};
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
            <label for="basicform-url">Url</label>
            <input class="value" id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->attributes(['class' => 'value'])->input(InputUrl::tag())->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input class="value" id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->class('value')->input(InputUrl::tag())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->containerAttributes(['class' => 'value'])
                ->input(InputUrl::tag())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->containerClass('value')->input(InputUrl::tag())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->containerTag(Block::DIV)->input(InputUrl::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->containerTag(false)->input(InputUrl::tag())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->containerTag(Block::ARTICLE)->input(InputUrl::tag())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Url</label>
            <input id="value" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->id('value')->input(InputUrl::tag())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
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
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
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
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->inputContainerTag(Block::DIV)->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->inputContainerTag(Block::ARTICLE)->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <label for="basicform-url">Url</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="value" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->name('value')->input(InputUrl::tag())->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->prefix('Prefix')->render()
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
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
                ->prefix('prefix')
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
            prefix
            </div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
                ->prefix('prefix')
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
            prefix
            </div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->prefix('prefix')->prefixTag(Block::DIV)->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->prefix('prefix')->prefixTag(false)->render()
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->prefix('prefix')->prefixTag(Inline::SPAN)->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
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
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')
                ->input(InputUrl::tag())
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
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->suffix('suffix')->suffixTag(Block::DIV)->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->suffix('suffix')->suffixTag(false)->render()
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->suffix('suffix')->suffixTag(Inline::SPAN)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->template('<div>\n{field}\n</div>')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url" value="#000000">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('url', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('url')->input(InputUrl::tag())->render()
        );

        $formModel->setValue('url', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url" value="#000000">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('url')->input(InputUrl::tag())->render()
        );

        // null value
        $formModel->setValue('url', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('url')->input(InputUrl::tag())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Url</label>
            <input name="BasicForm[url]" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" type="url">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->input(InputUrl::tag())->name(null)->render()
        );
    }
}
