<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\TextArea};
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
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->input(TextArea::tag())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(TextArea::tag())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->input(TextArea::tag())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <div id="basicform-hint-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintContent('Hint')->input(TextArea::tag())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->input(TextArea::tag())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(false)->input(TextArea::tag())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="basicform-hint-help">\n</textarea>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Inline::SPAN)->input(TextArea::tag())->render()
        );
    }
}
