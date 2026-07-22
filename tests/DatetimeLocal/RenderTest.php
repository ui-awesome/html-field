<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\DatetimeLocal;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputDateTimeLocal};
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
            <input class="value" id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputDateTimeLocal::tag())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input class="value" id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->class('value')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputDateTimeLocal::tag())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerClass('value')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerTag(Block::DIV)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->containerTag(false)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->containerTag(Block::ARTICLE)
                ->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Date Of Birth</label>
            <input id="value" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->id('value')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
                ->inputContainerTag(false)
                ->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="value" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->prefix('Prefix')->render()
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')
                ->input(InputDateTimeLocal::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputDateTimeLocal::tag())->render()
        );

        // null value
        $formModel->setValue('dateOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('dateOfBirth')->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Date Of Birth</label>
            <input name="BasicForm[dateOfBirth]" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->id(null)->input(InputDateTimeLocal::tag())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" type="datetime-local">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('dateOfBirth')->input(InputDateTimeLocal::tag())->name(null)->render()
        );
    }
}
