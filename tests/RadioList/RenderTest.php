<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, ChoiceItem, ChoiceList};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see ChoiceList}.
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
            <div>
            <input class="value" id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input class="value" id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->attributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input class="value" id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input class="value" id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->class('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerClass('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::DIV)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::ARTICLE)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="value-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="value-w0">No</label>
            <input id="value-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="value-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->value(0)->label('No'),
                            ChoiceItem::radio()->value(1)->label('Yes'),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->inputContainerTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->inputContainerTag(Block::ARTICLE)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <label>Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="value" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="value" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->value(0)->label('No'),
                            ChoiceItem::radio()->value(1)->label('Yes'),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input name="BasicForm[agree]" type="hidden" value="none">
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0" checked>
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "'int' value must check the matching item.",
        );

        // string values
        $formModel->setValue('agree', '1');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "'string' value must check the matching item.",
        );

        // value not in list
        $formModel->setValue('agree', 7);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            'Unlisted value must check no item.',
        );

        // null value
        $formModel->setValue('fruits', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits]" type="radio" value="0">
            <label for="basicform-fruits-w0">No</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits]" type="radio" value="1">
            <label for="basicform-fruits-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-agree-w0" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
