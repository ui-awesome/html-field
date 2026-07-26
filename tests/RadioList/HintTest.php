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
 * Unit tests for {@see Field} hint rendering with {@see RadioList}.
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->input(self::radioList())
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
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
                ->input(self::radioList())
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
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
                ->input(self::radioList())
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
            <div id="basicform-agree" aria-describedby="basicform-agree-help">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
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
                ->input(self::radioList())
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
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
                ->input(self::radioList())
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
            </div>
            This is a hint.
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(false)
                ->input(self::radioList())
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
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint]" type="radio" value="0">
            <label for="basicform-hint-0">No</label>
            <input id="basicform-hint-1" name="BasicForm[hint]" type="radio" value="1">
            <label for="basicform-hint-1">Yes</label>
            </div>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(self::radioList())
                ->render(),
            'Hint must render as the given tag.',
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
