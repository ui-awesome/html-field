<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputWeek};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;

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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputWeek::tag())
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->class('value')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputWeek::tag())
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->containerClass('value')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->containerTag(Block::DIV)->input(InputWeek::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->containerTag(false)->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->containerTag(Block::ARTICLE)->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->id('value')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->inputContainerTag(Block::DIV)->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->inputContainerTag(false)->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->inputContainerTag(Block::ARTICLE)->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->name('value')->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->prefix('Prefix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')
                ->input(InputWeek::tag())
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->value('20')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('weekOfBirth', '20');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week" value="20">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('weekOfBirth')->input(InputWeek::tag())->render()
        );

        // null value
        $formModel->setValue('weekOfBirth', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('weekOfBirth')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->value(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->id(null)->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->input(InputWeek::tag())->name(null)->render()
        );
    }
}
