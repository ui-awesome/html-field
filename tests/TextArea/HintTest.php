<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\TextArea};

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
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->input(TextArea::widget())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')
                ->hintAttributes(['class' => 'value'])
                ->input(TextArea::widget())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintClass('value')->input(TextArea::widget())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <div id="basicform-hint-help">
            Hint
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintContent('Hint')->input(TextArea::widget())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag()->input(TextArea::widget())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            This is a hint.
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag(false)->input(TextArea::widget())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <textarea id="basicform-hint" name="BasicForm[hint]"></textarea>
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag('span')->input(TextArea::widget())->render()
        );
    }
}
