<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\TextArea;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\TextArea};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(TextArea::widget())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><textarea id="basicform-label" name="BasicForm[label]"></textarea></label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->enclosedByLabel(true)->input(TextArea::widget())->render()
        );
    }

    public function testLabelContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <textarea id="basicform-label" name="BasicForm[label]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(TextArea::widget())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="class" for="basicform-label">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(TextArea::widget())
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
            <textarea id="basicform-label" name="BasicForm[label]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(TextArea::widget())->labelClass('class')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]"></textarea>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(TextArea::widget())->labelFor('value')->render()
        );
    }
}
