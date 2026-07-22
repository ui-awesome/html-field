<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputRadio};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;

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
            Field::tag()->formModel(new BasicForm())->property('hint')->input(InputRadio::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(InputRadio::tag())
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
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->input(InputRadio::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->hintContent('Hint')->input(InputRadio::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->input(InputRadio::tag())->render()
        );
    }
}
