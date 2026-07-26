<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputMonth;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} hint rendering with {@see InputMonth}.
 */
#[Group('month')]
final class HintTest extends TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->input(InputMonth::tag())
                ->render(),
            'Hint content must be rendered.',
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(InputMonth::tag())
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintClass('value')
                ->input(InputMonth::tag())
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month" aria-describedby="basicform-monthofbirth-help">
            <div id="basicform-monthofbirth-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('monthOfBirth')
                ->hintContent('Hint')
                ->input(InputMonth::tag())
                ->render(),
            'Hint content must be rendered.',
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Block::DIV)
                ->input(InputMonth::tag())
                ->render(),
            "Hint must render as '<div>'.",
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(false)
                ->input(InputMonth::tag())
                ->render(),
            'Hint tag must be omitted.',
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="month" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(InputMonth::tag())
                ->render(),
            'Hint must render as the given tag.',
        );
    }
}
