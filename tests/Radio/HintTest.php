<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Radio};

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
            <input id="basicform-hint" name="BasicForm[hint]" type="radio" aria-describedby="basicform-hint-help">
            <label for="basicform-hint">Hint</label>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->input(Radio::widget())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="radio" aria-describedby="basicform-hint-help">
            <label for="basicform-hint">Hint</label>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')
                ->hintAttributes(['class' => 'value'])
                ->input(Radio::widget())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="radio" aria-describedby="basicform-hint-help">
            <label for="basicform-hint">Hint</label>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintClass('value')->input(Radio::widget())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" aria-describedby="basicform-agree-help">
            <label for="basicform-agree">Agree</label>
            <div id="basicform-agree-help">
            Hint
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->hintContent('Hint')->input(Radio::widget())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="radio" aria-describedby="basicform-hint-help">
            <label for="basicform-hint">Hint</label>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag()->input(Radio::widget())->render()
        );
    }
}
