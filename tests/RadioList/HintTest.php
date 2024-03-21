<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Radio, FormControl\Input\RadioList};

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
            Field::widget(new BasicForm(), 'hint')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            Field::widget(new BasicForm(), 'hint')
                ->hintAttributes(['class' => 'value'])
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            Field::widget(new BasicForm(), 'hint')
                ->hintClass('value')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            Field::widget(new BasicForm(), 'agree')
                ->hintContent('Hint')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            Field::widget(new BasicForm(), 'hint')
                ->hintTag()
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            This is a hint.
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')
                ->hintTag(false)
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
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
            <input id="basicform-hint-w0" name="BasicForm[hint]" type="radio" value="0" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w0">No</label>
            <input id="basicform-hint-w1" name="BasicForm[hint]" type="radio" value="1" aria-describedby="basicform-hint-help">
            <label for="basicform-hint-w1">Yes</label>
            </div>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')
                ->hintTag('span')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }
}
