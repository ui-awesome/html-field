<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Datetime;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputText};
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input class="value" id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->class('value')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerClass('value')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerTag(Block::DIV)->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerTag(false)->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->containerTag(Block::ARTICLE)->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->id('value')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->inputContainerTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->inputContainerTag(false)->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->inputContainerTag(Block::ARTICLE)
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->name('value')->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->prefix('Prefix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->value('1996-12-19T16:39:57-08:00')
                ->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('dateOfBirth', '1996-12-19T16:39:57-08:00');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
        );

        // null value
        $formModel->setValue('dateOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->value(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->id(null)->input(InputText::tag()->addAttribute('type', 'datetime'))->render()
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
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputText::tag()->addAttribute('type', 'datetime'))->name(null)->render()
        );
    }
}
