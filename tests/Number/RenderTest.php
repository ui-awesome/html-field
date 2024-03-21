<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Number};

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
            <label for="basicform-amount">Amount</label>
            <input class="value" id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->attributes(['class' => 'value'])
                ->input(Number::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input class="value" id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->class('value')->input(Number::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->containerAttributes(['class' => 'value'])
                ->input(Number::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->containerClass('value')->input(Number::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->containerTag()->input(Number::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            HTML,
            Field::widget(new BasicForm(), 'amount')->containerTag(false)->input(Number::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'amount')->containerTag('article')->input(Number::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Amount</label>
            <input id="value" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->id('value')->input(Number::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <label for="basicform-amount">Amount</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="value" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->prefix('Prefix')->render()
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->prefix('prefix')->prefixTag()->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')
                ->input(Number::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number" value="20">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->value('20')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('amount', '20');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number" value="20">
            </div>
            HTML,
            Field::widget($formModel, 'amount')->input(Number::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('amount', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget($formModel, 'amount')->input(Number::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Amount</label>
            <input name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->id(null)->input(Number::widget())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'amount')->input(Number::widget())->name(null)->render()
        );
    }
}
