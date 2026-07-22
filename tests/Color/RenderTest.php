<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputColor};
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
            <label for="basicform-color">Color</label>
            <input class="value" id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->attributes(['class' => 'value'])->input(InputColor::tag())->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input class="value" id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->class('value')->input(InputColor::tag())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->containerAttributes(['class' => 'value'])
                ->input(InputColor::tag())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->containerClass('value')->input(InputColor::tag())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::DIV)->input(InputColor::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(false)->input(InputColor::tag())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::ARTICLE)->input(InputColor::tag())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Color</label>
            <input id="value" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->id('value')->input(InputColor::tag())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->inputContainerTag(Block::DIV)
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->inputContainerTag(false)
                ->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->inputContainerTag(Block::ARTICLE)
                ->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <label for="basicform-color">Color</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="value" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->prefix('Prefix')->render()
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')
                ->input(InputColor::tag())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" value="#000000">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('color', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->input(InputColor::tag())->render()
        );

        $formModel->setValue('color', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" value="#000000">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->input(InputColor::tag())->render()
        );

        // null value
        $formModel->setValue('color', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('color')->input(InputColor::tag())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputColor::tag())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Color</label>
            <input name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->id(null)->input(InputColor::tag())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" type="color">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->input(InputColor::tag())->name(null)->render()
        );
    }
}
