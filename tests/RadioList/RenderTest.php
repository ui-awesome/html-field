<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Field\Tests\Support\ChoiceItem, Field\Tests\Support\ChoiceList};
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
            <label>Agree</label>
            <div>
            <input class="value" id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input class="value" id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->attributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->class('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerClass('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerTag(Block::DIV)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerTag(Block::ARTICLE)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->id('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->value(0)->label('No'),
                            ChoiceItem::radio()->value(1)->label('Yes'),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->inputContainerTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->inputContainerTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->inputContainerTag(Block::ARTICLE)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->value(0)->label('No'),
                            ChoiceItem::radio()->value(1)->label('Yes'),
                        )
                )
                ->name('value')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->prefix('Prefix')
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
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
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
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
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
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
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
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
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
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->template('<div>\n{field}\n</div>')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                        ->uncheckedValue('none')
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->value(1)
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->value(null)
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->id(null)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->name(null)
                ->render()
        );
    }
}
