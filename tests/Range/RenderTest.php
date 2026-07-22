<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Range;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputRange};
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input class="value" id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputRange::tag())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input class="value" id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->class('value')->input(InputRange::tag())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputRange::tag())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->containerClass('value')->input(InputRange::tag())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->containerTag(Block::DIV)->input(InputRange::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->containerTag(false)->input(InputRange::tag())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->containerTag(Block::ARTICLE)->input(InputRange::tag())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Month Of Birth</label>
            <input id="value" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->id('value')->input(InputRange::tag())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
                ->inputContainerTag(Block::DIV)
                ->render()
        );
    }

    public function testInputContainerWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->inputContainerTag(false)->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <label for="basicform-monthofbirth">Month Of Birth</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <input id="basicform-monthofbirth" name="value" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->name('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->prefix('Prefix')->render()
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')
                ->input(InputRange::tag())
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
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range" value="11">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->value('11')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('monthOfBirth', '11');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range" value="11">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('monthOfBirth')->input(InputRange::tag())->render()
        );

        // null value
        $formModel->setValue('monthOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('monthOfBirth')->input(InputRange::tag())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Month Of Birth</label>
            <input name="BasicForm[monthOfBirth]" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->id(null)->input(InputRange::tag())->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" type="range">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('monthOfBirth')->input(InputRange::tag())->name(null)->render()
        );
    }
}
