<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Number;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Number};

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
            <input id="basicform-label" name="BasicForm[label]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Number::widget())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="number"></label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Number::widget())->enclosedByLabel(true)->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Number::widget())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Number::widget())
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
            <input id="basicform-label" name="BasicForm[label]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Number::widget())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="number">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Number::widget())->labelFor('value')->render()
        );
    }
}
