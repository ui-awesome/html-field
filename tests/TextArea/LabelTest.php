<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\TextArea;

/**
 * Unit tests for {@see Field} label rendering with {@see TextArea}.
 */
#[Group('textarea')]
final class LabelTest extends TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(TextArea::tag())
                ->render(),
            'Label must be omitted.',
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><textarea id="basicform-label" name="BasicForm[label]">\n</textarea></label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->enclosedByLabel(true)
                ->input(TextArea::tag())
                ->render(),
            'Label must enclose the control.',
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="class" for="basicform-label">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(TextArea::tag())
                ->labelAttributes(['class' => 'class'])
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="class" for="basicform-label">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(TextArea::tag())
                ->labelClass('class')
                ->render(),
            "Label 'class' must be serialized.",
        );
    }

    public function testLabelContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(TextArea::tag())
                ->label('Label')
                ->render(),
            'Label content must be rendered.',
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(TextArea::tag())
                ->labelFor('value')
                ->render(),
            "'for' must use the given value.",
        );
    }
}
