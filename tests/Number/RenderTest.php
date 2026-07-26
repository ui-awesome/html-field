<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputNumber;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputNumber}.
 */
#[Group('number')]
final class RenderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->attributes(['class' => 'value'])
                ->input(InputNumber::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->class('value')
                ->input(InputNumber::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerAttributes(['class' => 'value'])
                ->input(InputNumber::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerClass('value')
                ->input(InputNumber::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerTag(Block::DIV)
                ->input(InputNumber::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerTag(false)
                ->input(InputNumber::tag())
                ->render(),
            'Container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->containerTag(Block::ARTICLE)
                ->input(InputNumber::tag())
                ->render(),
            'Container must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->id('value')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
                ->inputContainerTag(false)
                ->render(),
            'Input container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="value" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
                ->render(),
            'Default field structure must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
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
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number" value="20">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
                ->value('20')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('amount', '20');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number" value="20">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('amount')
                ->input(InputNumber::tag())
                ->render(),
            "'value' must reflect the model value.",
        );

        // null value
        $formModel->setValue('amount', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-amount">Amount</label>
            <input id="basicform-amount" name="BasicForm[amount]" type="number">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('amount')
                ->input(InputNumber::tag())
                ->render(),
            "'null' must omit the 'value' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
                ->value(null)
                ->render(),
            "'null' must omit the 'value' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->id(null)
                ->input(InputNumber::tag())
                ->render(),
            "'null' must omit 'id' and the label 'for'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('amount')
                ->input(InputNumber::tag())
                ->name(null)
                ->render(),
            "'null' must omit the 'name' attribute.",
        );
    }
}
