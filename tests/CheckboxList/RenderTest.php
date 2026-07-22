<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use UIAwesome\{
    Html\Field\Field,
    Html\Field\Tests\Support\BasicForm,
    Html\Field\Tests\Support\ChoiceItem,
    Html\Field\Tests\Support\ChoiceList
};
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
            <label>Fruits</label>
            <div>
            <input class="value" id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input class="value" id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input class="value" id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->attributes(['class' => 'value'])
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->containerAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->containerClass('value')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->containerTag(Block::DIV)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->containerTag(false)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->containerTag(Block::ARTICLE)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="value-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="value-w0">Apple</label>
            <input id="value-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="value-w1">Banana</label>
            <input id="value-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="value-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->id('value')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <label>Fruits</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->inputContainerTag(Block::DIV)
                ->inputTemplate("{input}\n{label}")
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="value[]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="value[]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="value[]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <article>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->template('<article>\n{field}\n</article>')
                ->render()
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input name="BasicForm[fruits][]" type="hidden" value="0">
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->value(1)->label('Apple'),
                            ChoiceItem::checkbox()->value(2)->label('Banana'),
                            ChoiceItem::checkbox()->value(3)->label('Orange'),
                        )
                        ->uncheckedValue('0')
                )
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1" checked>
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3" checked>
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->value([1, 3])
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2" checked>
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
        );

        // array with string values
        $formModel->setValue('fruits', ['2', '3']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2" checked>
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3" checked>
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
        );

        // value not in array
        $formModel->setValue('fruits', [7]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
        );

        // empty array value
        $formModel->setValue('fruits', []);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->id(null)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->name(null)
                ->render()
        );
    }
}
