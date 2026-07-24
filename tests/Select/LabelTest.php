<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, SelectControl};

/**
 * Unit tests for {@see Field} label rendering with {@see SelectControl}.
 */
#[Group('select')]
final class LabelTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->notLabel()
                ->input(SelectControl::tag()
                ->items([1 => 'Apple']))
                ->render(),
            'Label must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->label('Label')
                ->render(),
            'Label content must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->labelAttributes(['class' => 'value'])
                ->render(),
            "Label 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->labelClass('value')
                ->render(),
            "Label 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->input(SelectControl::tag()->items([1 => 'Apple']))
                ->labelFor('value')
                ->render(),
            "'for' must use the given value.",
        );
    }
}
