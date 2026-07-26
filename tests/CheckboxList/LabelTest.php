<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem};

/**
 * Unit tests for {@see Field} label rendering with {@see CheckboxList}.
 */
#[Group('checkboxlist')]
final class LabelTest extends TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">Apple</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Banana</label>
            <input id="basicform-label-2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(self::checkboxList())
                ->render(),
            'Label must be omitted.',
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <label for="basicform-fruits-0"><input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">Apple</label>
            <label for="basicform-fruits-1"><input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">Banana</label>
            <label for="basicform-fruits-2"><input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::checkboxList())
                ->enclosedByLabel(true)
                ->render(),
            'Label must enclose the control.',
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Label</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">Apple</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Banana</label>
            <input id="basicform-label-2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::checkboxList())
                ->label('Label')
                ->render(),
            'Label content must be rendered.',
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value">This is a label.</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">Apple</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Banana</label>
            <input id="basicform-label-2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::checkboxList())
                ->labelAttributes(['class' => 'value'])
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value">This is a label.</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">Apple</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Banana</label>
            <input id="basicform-label-2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::checkboxList())
                ->labelClass('value')
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Label</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label class="value" for="basicform-label-0">Apple</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Banana</label>
            <input id="basicform-label-2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-2">Orange</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    CheckboxList::tag()
                        ->items(
                            ChoiceItem::tag()->label('Apple')->labelClass('value')->value(1),
                            ChoiceItem::tag()->label('Banana')->value(2),
                            ChoiceItem::tag()->label('Orange')->value(3),
                        )
                )
                ->label('Label')
                ->render(),
            "Item label 'class' must be serialized.",
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
