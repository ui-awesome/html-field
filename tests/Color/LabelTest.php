<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Color};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel()
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Color::widget())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="color"></label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Color::widget())->enclosedByLabel(true)->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Color::widget())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Color::widget())
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
            <input id="basicform-label" name="BasicForm[label]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Color::widget())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="color">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Color::widget())->labelFor('value')->render()
        );
    }
}
