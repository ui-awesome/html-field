<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputCheckbox};
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
            <input class="value" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->attributes(['class' => 'value'])
                ->input(InputCheckbox::tag())
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
            Field::tag()->formModel(new BasicForm())->property('agree')->class('value')->input(InputCheckbox::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(InputCheckbox::tag())
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
            Field::tag()->formModel(new BasicForm())->property('agree')->containerClass('value')->input(InputCheckbox::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->containerTag(Block::ARTICLE)->input(InputCheckbox::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->containerTag(false)->input(InputCheckbox::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->id('value')->input(InputCheckbox::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->inputContainerTag(Block::DIV)->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->inputContainerTag(false)->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->inputContainerTag(Block::ARTICLE)->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
                ->inputContainerTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->prefix('Prefix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->prefix('prefix')->prefixTag(Block::DIV)->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
                ->prefix('prefix')
                ->prefixTag(Block::ARTICLE)
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->input(InputCheckbox::tag())
                ->prefix('prefix')
                ->suffix('suffix')
                ->template('{field}')
                ->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag()->value('ok'))->value('ok')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // bool value
        $formModel->setValue('agree', false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value(true))->render()
        );

        $formModel->setValue('agree', true);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value(true))->render()
        );

        // int value
        $formModel->setValue('agree', 0);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value(1))->render()
        );

        $formModel->setValue('agree', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value(1))->render()
        );

        // string value
        $formModel->setValue('agree', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value('ok'))->render()
        );

        $formModel->setValue('agree', 'ok');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value('ok'))->render()
        );

        // null value
        $formModel->setValue('agree', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')->input(InputCheckbox::tag()->value('ok'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag())->value(null)->render()
        );
    }

    public function testValueWithoutUncheckedCompanion(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('agree')->input(InputCheckbox::tag()->value(1))->render()
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
            Field::tag()->formModel(new BasicForm())->property('email')->input(InputCheckbox::tag())->id(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('email')->input(InputCheckbox::tag())->name(null)->render()
        );
    }
}
