<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Week};

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
            <input id="basicform-label" name="BasicForm[label]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Week::widget())->render()
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
            Field::widget(new BasicForm(), 'label')->enclosedByLabel(true)->input(Week::widget())->render()
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
            Field::widget(new BasicForm(), 'label')->input(Week::widget())->label('Label')->render()
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
            Field::widget(new BasicForm(), 'label')
                ->input(Week::widget())
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
            Field::widget(new BasicForm(), 'label')->input(Week::widget())->labelClass('value')->render()
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
            Field::widget(new BasicForm(), 'label')->input(Week::widget())->labelFor('value')->render()
        );
    }
}
