<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputWeek};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputWeek::tag())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="week"></label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(InputWeek::tag())->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputWeek::tag())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputWeek::tag())
                ->labelAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputWeek::tag())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputWeek::tag())->labelFor('value')->render()
        );
    }
}
