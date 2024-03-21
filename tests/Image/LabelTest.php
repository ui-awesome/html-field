<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Image;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Image};

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
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Image::widget())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="image"></label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Image::widget())->enclosedByLabel(true)->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Image::widget())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Image::widget())
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
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Image::widget())->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="image">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Image::widget())->labelFor('value')->render()
        );
    }
}
