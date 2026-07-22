<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputUrl};
use UIAwesome\Html\Field\Tests\Support\Assert;

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
            Field::tag()->formModel(new BasicForm())->property('label')->notLabel()->input(InputUrl::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->enclosedByLabel(true)->input(InputUrl::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputUrl::tag())->label('Label')->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')
                ->input(InputUrl::tag())
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputUrl::tag())->labelClass('class')->render()
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
            Field::tag()->formModel(new BasicForm())->property('label')->input(InputUrl::tag())->labelFor('value')->render()
        );
    }
}
