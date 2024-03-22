<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Checkbox};

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
            <input class="value" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->attributes(['class' => 'value'])
                ->input(Checkbox::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->class('value')->input(Checkbox::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->containerAttributes(['class' => 'value'])
                ->input(Checkbox::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->containerClass('value')->input(Checkbox::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </article>
            HTML,
            Field::widget(new BasicForm(), 'agree')->containerTag('article')->input(Checkbox::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            HTML,
            Field::widget(new BasicForm(), 'agree')->containerTag(false)->input(Checkbox::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="value" name="BasicForm[agree]" type="checkbox">
            <label for="value">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->id('value')->input(Checkbox::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->inputContainerTag()->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->inputContainerTag('article')->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-agree">Agree</label>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
                ->inputContainerTag()
                ->inputTemplate('{label}\n{input}')
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->prefix('Prefix')->render()
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->prefix('prefix')->prefixTag()->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <article>
            prefix
            </article>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
                ->prefix('prefix')
                ->prefixTag('article')
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->input(Checkbox::widget())
                ->prefix('prefix')
                ->suffix('suffix')
                ->template('{field}')
                ->render()
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="BasicForm[agree]" type="hidden" value="0">
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget()->uncheckedValue('0')->value(1))->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget()->value('ok'))->value('ok')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // bool value
        $formModel->setPropertyValue('agree', false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value(true))->render()
        );

        $formModel->setPropertyValue('agree', true);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value(true))->render()
        );

        // int value
        $formModel->setPropertyValue('agree', 0);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value(1))->render()
        );

        $formModel->setPropertyValue('agree', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value(1))->render()
        );

        // string value
        $formModel->setPropertyValue('agree', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value('ok'))->render()
        );

        $formModel->setPropertyValue('agree', 'ok');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value('ok'))->render()
        );

        // null value
        $formModel->setPropertyValue('agree', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget($formModel, 'agree')->input(Checkbox::widget()->value('ok'))->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')->input(Checkbox::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="BasicForm[email]" type="checkbox">
            <label>Email</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')->input(Checkbox::widget())->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-email" type="checkbox">
            <label for="basicform-email">Email</label>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')->input(Checkbox::widget())->name(null)->render()
        );
    }
}
