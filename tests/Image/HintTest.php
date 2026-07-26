<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputImage;
use UIAwesome\Html\Interop\Inline;

/**
 * Unit tests for {@see Field} hint rendering with {@see InputImage}.
 */
#[Group('image')]
final class HintTest extends TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->input(InputImage::tag())
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
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(InputImage::tag())
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
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintClass('value')
                ->input(InputImage::tag())
                ->render(),
            "Hint 'class' must be serialized.",
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-image">Image</label>
            <input id="basicform-image" name="BasicForm[image]" type="image" aria-describedby="basicform-image-help">
            <div id="basicform-image-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('image')
                ->hintContent('Hint')
                ->input(InputImage::tag())
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
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(InputImage::tag())
                ->render(),
            'Hint must render as the given tag.',
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(false)
                ->input(InputImage::tag())
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
            <input id="basicform-hint" name="BasicForm[hint]" type="image" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('hint')
                ->hintTag(Inline::SPAN)
                ->input(InputImage::tag())
                ->render(),
            'Hint must render as the given tag.',
        );
    }
}
