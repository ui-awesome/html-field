<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputColor};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class HintTest extends \PHPUnit\Framework\TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->input(InputColor::tag())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintAttributes(['class' => 'value'])->input(InputColor::tag())->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->input(InputColor::tag())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" aria-describedby="basicform-color-help">
            <div id="basicform-color-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('color')->hintContent('Hint')->input(InputColor::tag())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->input(InputColor::tag())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(false)->input(InputColor::tag())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="color" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Inline::SPAN)->input(InputColor::tag())->render()
        );
    }
}
