<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, ChoiceItem, ChoiceList};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} hint rendering with {@see ChoiceList}.
 */
#[Group('radiolist')]
final class HintTest extends TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            'Hint content must be rendered.',
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintClass('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0" aria-describedby="basicform-agree-help">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1" aria-describedby="basicform-agree-help">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div id="basicform-agree-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->hintContent('Hint')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            'Hint content must be rendered.',
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Block::DIV)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Hint must render as '<div>'.",
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            This is a hint.
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            'Hint tag must be omitted.',
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div>
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            'Hint must render as the given tag.',
        );
    }
}
