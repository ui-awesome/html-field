<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\DatetimeLocal;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputDateTimeLocal};
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
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(InputDateTimeLocal::tag())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local" aria-describedby="basicform-dateofbirth-help">
            <div id="basicform-dateofbirth-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->hintContent('Hint')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(false)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="datetime-local" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Inline::SPAN)->input(InputDateTimeLocal::tag())->render()
        );
    }
}
