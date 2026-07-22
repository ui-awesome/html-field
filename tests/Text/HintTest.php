<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm};
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
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintAttributes(['class' => 'value'])->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" aria-describedby="basicform-username-help">
            <div id="basicform-username-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->hintContent('Hint')->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(false)->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Inline::SPAN)->render()
        );
    }
}
