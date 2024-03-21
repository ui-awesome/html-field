<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\{
    Field\Field,
    Field\Tests\Support\BasicForm,
    FormControl\Input\Checkbox,
    FormControl\Input\CheckboxList
};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-w0">Apple</label>
            <input id="basicform-label-w1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-w1">Banana</label>
            <input id="basicform-label-w2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->disableLabel()
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <label for="basicform-fruits-w0"><input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">Apple</label>
            <label for="basicform-fruits-w1"><input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">Banana</label>
            <label for="basicform-fruits-w2"><input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'fruits')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->enclosedByLabel(true)
                ->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Label</label>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-w0">Apple</label>
            <input id="basicform-label-w1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-w1">Banana</label>
            <input id="basicform-label-w2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->label('Label')
                ->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value">This is a label.</label>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-w0">Apple</label>
            <input id="basicform-label-w1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-w1">Banana</label>
            <input id="basicform-label-w2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->labelAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value">This is a label.</label>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-w0">Apple</label>
            <input id="basicform-label-w1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-w1">Banana</label>
            <input id="basicform-label-w2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->labelClass('value')
                ->render()
        );
    }

    public function testLabelItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Label</label>
            <div>
            <input id="basicform-label-w0" name="BasicForm[label][]" type="checkbox" value="1">
            <label class="value" for="basicform-label-w0">Apple</label>
            <input id="basicform-label-w1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-w1">Banana</label>
            <input id="basicform-label-w2" name="BasicForm[label][]" type="checkbox" value="3">
            <label for="basicform-label-w2">Orange</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->labelClass('value')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->label('Label')
                ->render()
        );
    }
}
