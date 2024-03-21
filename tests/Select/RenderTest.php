<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Select};

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
            <label for="basicform-fruits">Fruits</label>
            <select class="value" id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->attributes(['class' => 'value'])
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select class="value" id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->class('value')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->containerAttributes(['class' => 'value'])
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->containerClass('value')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->containerTag()
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->containerTag(false)
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </article>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->containerTag('article')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Fruits</label>
            <select id="value" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->id('value')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <label for="basicform-fruits">Fruits</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="value">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->name('value')
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->prefix('prefix')
                ->render()
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <article>
            prefix
            </article>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->prefix('prefix')
                ->prefixTag('article')
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1" selected>Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')->input(Select::widget()->items([1 => 'Apple']))->value(1)->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // int value
        $formModel->setPropertyValue('fruits', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1" selected>Apple</option>
            </select>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );

        // string value
        $formModel->setPropertyValue('fruits', '1');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1" selected>Apple</option>
            </select>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );

        // array value
        $formModel->setPropertyValue('fruits', [2, 3]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            <option value="2" selected>Banana</option>
            <option value="3" selected>Orange</option>
            <option value="4">Pineapple</option>
            </select>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')
                ->input(
                    Select::widget()
                        ->items(
                            [
                                1 => 'Apple',
                                2 => 'Banana',
                                3 => 'Orange',
                                4 => 'Pineapple',
                            ]
                        )
                )
                ->render()
        );

        // value not in items
        $formModel->setPropertyValue('fruits', 5);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );

        // null value.
        $formModel->setPropertyValue('fruits', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget($formModel, 'fruits')->input(Select::widget()->items([1 => 'Apple']))->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->value(null)
                ->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <select name="BasicForm[fruits]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')->id(null)->input(Select::widget()->items([1 => 'Apple']))->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->name(null)
                ->render()
        );
    }
}
