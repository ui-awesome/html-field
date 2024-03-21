<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\{
    Field\Field,
    Field\Tests\Support\BasicForm,
    FormControl\Input\Checkbox,
    FormControl\Input\CheckboxList,
};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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
            Field::widget(new BasicForm(), 'hint')
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
            Field::widget(new BasicForm(), 'hint')
                ->hintAttributes(['class' => 'value'])
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
            Field::widget(new BasicForm(), 'hint')
                ->hintClass('value')
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
            Field::widget(new BasicForm(), 'fruits')
                ->hintContent('Hint')
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
            Field::widget(new BasicForm(), 'hint')
                ->hintTag()
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
            Field::widget(new BasicForm(), 'hint')
                ->hintTag(false)
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
            Field::widget(new BasicForm(), 'hint')
                ->hintTag('span')
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
}
