<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputTime};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class RenderTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input class="value" id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputTime::tag())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input class="value" id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->class('value')->input(InputTime::tag())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputTime::tag())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->containerClass('value')->input(InputTime::tag())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->containerTag(Block::DIV)->input(InputTime::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->containerTag(false)->input(InputTime::tag())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->containerTag(Block::ARTICLE)->input(InputTime::tag())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Time Of Birth</label>
            <input id="value" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->id('value')->input(InputTime::tag())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag(Block::DIV)
                ->render()
        );
    }

    public function testInputContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->inputContainerClass('value')
                ->inputContainerTag(Block::DIV)
                ->render()
        );
    }

    public function testInputContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->inputContainerTag(Block::DIV)->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->inputContainerTag(Block::ARTICLE)->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <label for="basicform-timeofbirth">Time Of Birth</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="value" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->prefix('Prefix')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag(Block::DIV)
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag(Block::DIV)
                ->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            prefix
            </div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag(Block::DIV)
                ->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')
                ->input(InputTime::tag())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time" value="23:20:50.52">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->value('23:20:50.52')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('timeOfBirth', '23:20:50.52');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time" value="23:20:50.52">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('timeOfBirth')->input(InputTime::tag())->render()
        );

        // null value
        $formModel->setValue('timeOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('timeOfBirth')->input(InputTime::tag())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Time Of Birth</label>
            <input name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->id(null)->input(InputTime::tag())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" type="time">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('timeOfBirth')->input(InputTime::tag())->name(null)->render()
        );
    }
}
