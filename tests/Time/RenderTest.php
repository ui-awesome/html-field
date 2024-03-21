<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Time;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Time};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->attributes(['class' => 'value'])
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')->class('value')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')->containerClass('value')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->containerTag()->input(Time::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            HTML,
            Field::widget(new BasicForm(), 'timeOfBirth')->containerTag(false)->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->containerTag('article')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->id('value')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->inputContainerClass('value')
                ->inputContainerTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->inputContainerTag()->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->inputContainerTag(false)->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->inputContainerTag('article')->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->name('value')->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->prefix('Prefix')->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->prefix('prefix')
                ->prefixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->prefix('prefix')
                ->prefixTag('span')
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->suffix('suffix')->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->suffix('suffix')
                ->suffixTag()
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
                ->suffix('suffix')
                ->suffixTag('span')
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
            Field::widget(new BasicForm(), 'timeOfBirth')
                ->input(Time::widget())
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->value('23:20:50.52')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('timeOfBirth', '23:20:50.52');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time" value="23:20:50.52">
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->input(Time::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('timeOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-timeofbirth">Time Of Birth</label>
            <input id="basicform-timeofbirth" name="BasicForm[timeOfBirth]" type="time">
            </div>
            HTML,
            Field::widget($formModel, 'timeOfBirth')->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->value(null)->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->id(null)->input(Time::widget())->render()
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
            Field::widget(new BasicForm(), 'timeOfBirth')->input(Time::widget())->name(null)->render()
        );
    }
}
