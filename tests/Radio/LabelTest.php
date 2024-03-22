<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Radio};

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
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Radio::widget())->render()
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
            Field::widget(new BasicForm(), 'label')->enclosedByLabel(true)->input(Radio::widget())->render()
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
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Radio::widget())
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
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Radio::widget())
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
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            This is a label.
            </label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->enclosedByLabel(true)
                ->input(Radio::widget()->enclosedByLabel(true))
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
            Field::widget(new BasicForm(), 'label')->input(Radio::widget())->label('Label')->render()
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
            Field::widget(new BasicForm(), 'label')
                ->input(Radio::widget())
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
            Field::widget(new BasicForm(), 'label')->input(Radio::widget())->labelClass('value')->render()
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
            Field::widget(new BasicForm(), 'label')->input(Radio::widget())->labelFor('value')->render()
        );
    }
}
