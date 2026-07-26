<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{ChoiceItem, RadioList};

/**
 * Unit tests for {@see Field} label rendering with {@see RadioList}.
 */
#[Group('radiolist')]
final class LabelTest extends TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-0">No</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(self::radioList())
                ->render(),
            'Label must be omitted.',
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <label for="basicform-agree-0"><input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">No</label>
            <label for="basicform-agree-1"><input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(self::radioList())
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
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-0">No</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::radioList())
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
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-0">No</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::radioList())
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
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-0">No</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(self::radioList())
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
            <label>This is a label.</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="0">
            <label class="value" for="basicform-label-0">No</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    RadioList::tag()
                        ->items(
                            ChoiceItem::tag()->label('No')->labelClass('value')->value(0),
                            ChoiceItem::tag()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Item label 'class' must be serialized.",
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
