<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Url};

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
            <input id="basicform-label" name="BasicForm[label]" type="url">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->disableLabel()->input(Url::widget())->render()
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label"><input id="basicform-label" name="BasicForm[label]" type="url"></label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->enclosedByLabel(true)->input(Url::widget())->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <input id="basicform-label" name="BasicForm[label]" type="url">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Url::widget())->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="class" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="url">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Url::widget())
                ->labelAttributes(['class' => 'class'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="class" for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="url">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Url::widget())->labelClass('class')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="url">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')->input(Url::widget())->labelFor('value')->render()
        );
    }
}
