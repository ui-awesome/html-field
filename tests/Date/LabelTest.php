<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Date;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputDate};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="date">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputDate::tag())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="date"></label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputDate::tag())->enclosedByLabel(true)->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="date">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputDate::tag())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="date">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputDate::tag())
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
            <input id="basicform-label" name="BasicForm[label]" type="date">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputDate::tag())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="date">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputDate::tag())->labelFor('value')->render()
        );
    }
}
