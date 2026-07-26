<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{ChoiceItem, RadioList};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see RadioList}.
 */
#[Group('radiolist')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div class="value" id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->attributes(['class' => 'value'])
                ->input(self::radioList())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div class="value" id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->class('value')
                ->input(self::radioList())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(self::radioList())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerClass('value')
                ->input(self::radioList())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::DIV)
                ->input(self::radioList())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(false)
                ->input(self::radioList())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::ARTICLE)
                ->input(self::radioList())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="value">
            <input id="value-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="value-0">No</label>
            <input id="value-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="value-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id('value')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->inputContainerTag(false)
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->inputContainerTag(Block::ARTICLE)
                ->input(self::radioList())
                ->render(),
            'Input container must render as the given tag.',
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <label>Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="value" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="value" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
        );
    }

    public function testPrefixWithTagFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            'Prefix tag must be omitted.',
        );
    }

    public function testPrefixWithTagValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->render(),
            'Default layout must be rendered.',
        );
    }

    public function testSuffiAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix 'class' must be serialized.",
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->suffix('suffix')->render(),
            'Suffix must follow the input.',
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix must render as '<div>'.",
        );
    }

    public function testSuffixWithTagFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            'Suffix tag must be omitted.',
        );
    }

    public function testSuffixWithTagValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->template('<div>\n{field}\n</div>')
                ->render(),
            'Template must wrap the field.',
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input name="BasicForm[agree]" type="hidden" value="none">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    self::radioList()
                        ->uncheckedValue('none')
                )
                ->render(),
            'Hidden input must carry the unchecked value.',
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->value(1)
                ->render(),
            "'checked' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // int values
        $formModel->setValue('agree', 0);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0" checked>
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(self::radioList())
                ->render(),
            "'int' value must check the matching item.",
        );

        // string values
        $formModel->setValue('agree', '1');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(self::radioList())
                ->render(),
            "'string' value must check the matching item.",
        );

        // value not in list
        $formModel->setValue('agree', 7);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(self::radioList())
                ->render(),
            'Unlisted value must check no item.',
        );

        // null value
        $formModel->setValue('fruits', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits]" type="radio" value="0">
            <label for="basicform-fruits-0">No</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits]" type="radio" value="1">
            <label for="basicform-fruits-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(self::radioList())
                ->render(),
            "'null' must check no item.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->value(null)
                ->render(),
            "'null' must check no item.",
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input name="BasicForm[agree]" type="radio" value="0">
            <label>No</label>
            <input name="BasicForm[agree]" type="radio" value="1">
            <label>Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id(null)
                ->input(self::radioList())
                ->render(),
            "'id' and 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }

    private static function radioList(): RadioList
    {
        return RadioList::tag()->items(
            ChoiceItem::tag()->label('No')->value(0),
            ChoiceItem::tag()->label('Yes')->value(1),
        );
    }
}
