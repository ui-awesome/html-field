<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use UIAwesome\Html\{
    Field\Field,
    Field\Tests\Support\BasicForm,
    Field\Tests\Support\ChoiceItem,
    Field\Tests\Support\ChoiceList,
};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class HintTest extends \PHPUnit\Framework\TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
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

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintAttributes(['class' => 'value'])
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

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintClass('value')
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

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1" aria-describedby="basicform-fruits-help">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2" aria-describedby="basicform-fruits-help">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3" aria-describedby="basicform-fruits-help">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div id="basicform-fruits-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->hintContent('Hint')
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

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintTag(Block::DIV)
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

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintTag(false)
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

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint][]" type="checkbox" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">Apple</label>
            <input id="basicform-hint-w1" name="BasicForm[hint][]" type="checkbox" value="2" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Banana</label>
            <input id="basicform-hint-w2" name="BasicForm[hint][]" type="checkbox" value="3" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w2">Orange</label>
            </div>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintTag(Inline::SPAN)
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
}
