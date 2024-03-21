<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Datetime;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Datetime};
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input class="value" id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->attributes(['class' => 'value'])
                ->input(Datetime::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input class="value" id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->class('value')->input(Datetime::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(Datetime::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->containerClass('value')->input(Datetime::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->containerTag()->input(Datetime::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->containerTag(false)->input(Datetime::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->containerTag('article')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Date Of Birth</label>
            <input id="value" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->id('value')->input(Datetime::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
                ->inputContainerTag()
                ->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="value" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->prefix('Prefix')->render()
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')
                ->input(Datetime::widget())
                ->value('1996-12-19T16:39:57-08:00')
                ->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('dateOfBirth', '1996-12-19T16:39:57-08:00');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->input(Datetime::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('dateOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget($formModel, 'dateOfBirth')->input(Datetime::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Date Of Birth</label>
            <input name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->id(null)->input(Datetime::widget())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" type="datetime">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Datetime::widget())->name(null)->render()
        );
    }
}
