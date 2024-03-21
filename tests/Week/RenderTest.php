<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Week};

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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input class="value" id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->attributes(['class' => 'value'])
                ->input(Week::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input class="value" id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->class('value')->input(Week::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(Week::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->containerClass('value')->input(Week::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->containerTag()->input(Week::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->containerTag(false)->input(Week::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->containerTag('article')->input(Week::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Week Of Birth</label>
            <input id="value" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->id('value')->input(Week::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->inputContainerTag()->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->inputContainerTag('article')->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <label for="basicform-weekofbirth">Week Of Birth</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="value" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->prefix('Prefix')->render()
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')
                ->input(Week::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week" value="20">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->value('20')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('weekOfBirth', '20');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week" value="20">
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->input(Week::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('weekOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->input(Week::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Week Of Birth</label>
            <input name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->id(null)->input(Week::widget())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" type="week">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->input(Week::widget())->name(null)->render()
        );
    }
}
