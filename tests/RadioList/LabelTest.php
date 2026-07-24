<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, ChoiceItem, ChoiceList};

/**
 * Unit tests for {@see Field} label rendering with {@see ChoiceList}.
 */
#[Group('radiolist')]
final class LabelTest extends TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-w0">No</label>
            <input id="basicform-label-w1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <label for="basicform-agree-w0"><input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">No</label>
            <label for="basicform-agree-w1"><input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">Yes</label>
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
            <div>
            <input id="basicform-label-w0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-w0">No</label>
            <input id="basicform-label-w1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-label-w0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-w0">No</label>
            <input id="basicform-label-w1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-label-w0" name="BasicForm[label]" type="radio" value="0">
            <label for="basicform-label-w0">No</label>
            <input id="basicform-label-w1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
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
            <div>
            <input id="basicform-label-w0" name="BasicForm[label]" type="radio" value="0">
            <label class="value" for="basicform-label-w0">No</label>
            <input id="basicform-label-w1" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-w1">Yes</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->labelClass('value')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render(),
            "Item label 'class' must be serialized.",
        );
    }
}
