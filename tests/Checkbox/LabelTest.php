<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Checkbox};

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
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Checkbox::widget())->render()
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
            Field::widget(new BasicForm(), 'label')->enclosedByLabel(true)->input(Checkbox::widget())->render()
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
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Checkbox::widget())
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
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Checkbox::widget())
                ->labelFor('value')
                ->render()
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
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Checkbox::widget()->enclosedByLabel(true))
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
            Field::widget(new BasicForm(), 'label')->input(Checkbox::widget())->label('Label')->render()
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
            Field::widget(new BasicForm(), 'label')
                ->input(Checkbox::widget())
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
            Field::widget(new BasicForm(), 'label')->input(Checkbox::widget())->labelClass('value')->render()
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
            Field::widget(new BasicForm(), 'label')->input(Checkbox::widget())->labelFor('value')->render()
        );
    }
}
