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
 * Unit tests for {@see Field} hint rendering with {@see CheckboxList}.
 */
#[Group('checkboxlist')]
final class HintTest extends TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Hint</label>
            <div id="basicform-hint" aria-describedby="basicform-hint-help">
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->input(self::checkboxList())
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
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
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
                ->input(self::checkboxList())
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
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
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
                ->input(self::checkboxList())
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits" aria-describedby="basicform-fruits-help">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div id="basicform-fruits-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->hintContent('Hint')
                ->input(self::checkboxList())
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
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
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
                ->input(self::checkboxList())
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
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
            </div>
            This is a hint.
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(false)
                ->input(self::checkboxList())
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
            <input id="basicform-hint-0" name="BasicForm[hint][]" type="checkbox" value="1">
            <label for="basicform-hint-0">Apple</label>
            <input id="basicform-hint-1" name="BasicForm[hint][]" type="checkbox" value="2">
            <label for="basicform-hint-1">Banana</label>
            <input id="basicform-hint-2" name="BasicForm[hint][]" type="checkbox" value="3">
            <label for="basicform-hint-2">Orange</label>
            </div>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(self::checkboxList())
                ->render(),
            'Hint must render as the given tag.',
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
