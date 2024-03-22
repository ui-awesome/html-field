<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Month;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Month};

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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input class="value" id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->attributes(['class' => 'value'])
                ->input(Month::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input class="value" id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->class('value')->input(Month::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(Month::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->containerClass('value')->input(Month::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->containerTag()->input(Month::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->containerTag(false)->input(Month::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->containerTag('article')->input(Month::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Month Of Birth</label>
            <input id="value" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->id('value')->input(Month::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
                ->inputContainerTag('article')
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
                ->inputContainerTag('article')
                ->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="value" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->prefix('Prefix')->render()
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')
                ->input(Month::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month" value="11">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->value('11')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('monthOfBirth', '11');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month" value="11">
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Month::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('monthOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget($formModel, 'monthOfBirth')->input(Month::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Month Of Birth</label>
            <input name="BasicForm[monthOfBirth]" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->id(null)->input(Month::widget())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" type="month">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'monthOfBirth')->input(Month::widget())->name(null)->render()
        );
    }
}
