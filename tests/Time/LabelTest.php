<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputTime};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputTime::tag())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="time"></label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(InputTime::tag())->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputTime::tag())
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
            <input id="basicform-label" name="BasicForm[label]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputTime::tag())->labelClass('value')->render()
        );
    }

    public function testLabelContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputTime::tag())->label('Label')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputTime::tag())->labelFor('value')->render()
        );
    }
}
