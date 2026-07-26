<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see CheckboxList}.
 */
#[Group('checkboxlist')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div class="value" id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->attributes(['class' => 'value'])
                ->input(self::checkboxList())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div class="value" id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->class('value')
                ->input(self::checkboxList())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerAttributes(['class' => 'value'])
                ->input(self::checkboxList())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerClass('value')
                ->input(self::checkboxList())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(Block::DIV)
                ->input(self::checkboxList())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(false)
                ->input(self::checkboxList())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(Block::ARTICLE)
                ->input(self::checkboxList())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="value">
            <input id="value-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="value-0">Apple</label>
            <input id="value-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="value-1">Banana</label>
            <input id="value-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="value-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->id('value')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <label>Fruits</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->inputContainerTag(Block::DIV)
                ->inputTemplate("{input}\n{label}")
                ->render(),
            'Input template must reorder the parts.',
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="value[]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="value[]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="value[]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->name('value')
                ->render(),
            "'name' must use the given value.",
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            'Default structure must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
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
            <article>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->template('<article>\n{field}\n</article>')
                ->render(),
            'Template must wrap the field.',
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input name="BasicForm[fruits]" type="hidden" value="0">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(
                    self::checkboxList()
                        ->uncheckedValue('0')
                )
                ->render(),
            'Hidden companion input must be rendered.',
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1" checked>
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3" checked>
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->value([1, 3])
                ->render(),
            "Matching values must set 'checked'.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // array with int values
        $formModel->setValue('fruits', [2]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2" checked>
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            "Matching `int` must set 'checked'.",
        );

        // array with string values
        $formModel->setValue('fruits', ['2', '3']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2" checked>
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3" checked>
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            "Matching `string` values must set 'checked'.",
        );

        // value not in array
        $formModel->setValue('fruits', [7]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            "Unmatched value must not set 'checked'.",
        );

        // empty array value
        $formModel->setValue('fruits', []);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            "Empty array must not set 'checked'.",
        );

        // null value
        $formModel->setValue('fruits', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            "`null` must not set 'checked'.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->value(null)
                ->render(),
            "`null` must not set 'checked'.",
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input name="BasicForm[fruits][]" type="checkbox" value="1">
            <label>Apple</label>
            <input name="BasicForm[fruits][]" type="checkbox" value="2">
            <label>Banana</label>
            <input name="BasicForm[fruits][]" type="checkbox" value="3">
            <label>Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->id(null)
                ->input(self::checkboxList())
                ->render(),
            "'id' and 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }

    private static function checkboxList(): CheckboxList
    {
        return CheckboxList::tag()->items(
            ChoiceItem::tag()->label('Apple')->value(1),
            ChoiceItem::tag()->label('Banana')->value(2),
            ChoiceItem::tag()->label('Orange')->value(3),
        );
    }
}
