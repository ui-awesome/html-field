<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\TextArea};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(TextArea::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(TextArea::tag())
                ->labelAttributes(['class' => 'class'])
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(TextArea::tag())->labelClass('class')->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(TextArea::tag())->label('Label')->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(TextArea::tag())->labelFor('value')->render()
        );
    }
}
