<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Select};

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
            <select id="basicform-label" name="BasicForm[label]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->disableLabel()
                ->input(Select::widget()
                ->items([1 => 'Apple']))
                ->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">Label</label>
            <select id="basicform-label" name="BasicForm[label]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->label('Label')
                ->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="basicform-label">This is a label.</label>
            <select id="basicform-label" name="BasicForm[label]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Select::widget()->items([1 => 'Apple']))
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
            <select id="basicform-label" name="BasicForm[label]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->labelClass('value')
                ->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">This is a label.</label>
            <select id="basicform-label" name="BasicForm[label]">
            <option>Select an option</option>
            <option value="1">Apple</option>
            </select>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'label')
                ->input(Select::widget()->items([1 => 'Apple']))
                ->labelFor('value')
                ->render()
        );
    }
}
