<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputRadio};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputRadio::tag())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(InputRadio::tag())->render()
        );
    }

    public function testEnclosedByLabelWidget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputRadio::tag())
                ->render()
        );
    }

    public function testEnclosedByLabelWithLabelContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            Label
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputRadio::tag())
                ->label('Label')
                ->render()
        );
    }

    public function testEnclosedByLabelWithLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputRadio::tag())
                ->labelFor('value')
                ->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            <label for="basicform-label">Label</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputRadio::tag())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            <label class="value" for="basicform-label">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputRadio::tag())
                ->labelAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            <label class="value" for="basicform-label">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputRadio::tag())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            <label for="value">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputRadio::tag())->labelFor('value')->render()
        );
    }
}
