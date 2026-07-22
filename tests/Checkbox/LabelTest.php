<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputCheckbox};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputCheckbox::tag())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(InputCheckbox::tag())->render()
        );
    }

    public function testEnclosedByLabelWidget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputCheckbox::tag())
                ->render()
        );
    }

    public function testEnclosedByLabelWithLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            Label
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputCheckbox::tag())
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
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            This is a label.
            </label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->enclosedByLabel(true)
                ->input(InputCheckbox::tag())
                ->labelFor('value')
                ->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            <label for="basicform-label">Label</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputCheckbox::tag())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            <label class="value" for="basicform-label">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputCheckbox::tag())
                ->labelAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            <label class="value" for="basicform-label">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputCheckbox::tag())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            <label for="value">This is a label.</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputCheckbox::tag())->labelFor('value')->render()
        );
    }
}
