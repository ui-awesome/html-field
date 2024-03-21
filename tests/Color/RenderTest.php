<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Color};

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
            <label for="basicform-color">Color</label>
            <input class="value" id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')->attributes(['class' => 'value'])->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')->class('value')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')
                ->containerAttributes(['class' => 'value'])
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')->containerClass('value')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag()->input(Color::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag('article')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')->id('value')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
                ->inputContainerTag()
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
                ->inputContainerTag('article')
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->name('value')->render()
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
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->prefix('Prefix')->render()
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->suffix('suffix')->render()
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'color')
                ->input(Color::widget())
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
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('color', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget($formModel, 'color')->input(Color::widget())->render()
        );

        $formModel->setPropertyValue('color', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" value="#000000">
            </div>
            HTML,
            Field::widget($formModel, 'color')->input(Color::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('color', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::widget($formModel, 'color')->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Color::widget())->value(null)->render()
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
            Field::widget(new BasicForm(), 'color')->id(null)->input(Color::widget())->render()
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
            Field::widget(new BasicForm(), 'color')->input(Color::widget())->name(null)->render()
        );
    }
}
