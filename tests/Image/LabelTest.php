<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputImage;

/**
 * Unit tests for {@see Field} label rendering with {@see InputImage}.
 */
#[Group('image')]
final class LabelTest extends TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(InputImage::tag())
                ->render(),
            'Label must be omitted.',
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="image"></label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputImage::tag())
                ->enclosedByLabel(true)
                ->render(),
            'Label must enclose the control.',
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputImage::tag())
                ->label('Label')
                ->render(),
            'Label content must be rendered.',
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputImage::tag())
                ->labelAttributes(['class' => 'value'])
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputImage::tag())
                ->labelClass('value')
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(InputImage::tag())
                ->labelFor('value')
                ->render(),
            "'for' must use the given value.",
        );
    }
}
