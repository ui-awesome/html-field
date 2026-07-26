<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputWeek;
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} rendering with {@see InputWeek}.
 */
#[Group('week')]
final class RenderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputWeek::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->class('value')
                ->input(InputWeek::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputWeek::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->containerClass('value')
                ->input(InputWeek::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->containerTag(Block::DIV)
                ->input(InputWeek::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->containerTag(false)
                ->input(InputWeek::tag())
                ->render(),
            'Container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->containerTag(Block::ARTICLE)
                ->input(InputWeek::tag())
                ->render(),
            'Container must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->id('value')
                ->input(InputWeek::tag())
                ->render(),
            "'id' must propagate to the label 'for' and input.",
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
                ->render(),
            "Input container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->inputContainerClass('value')
                ->inputContainerTag(Block::DIV)
                ->render(),
            "Input container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->inputContainerTag(Block::DIV)
                ->render(),
            'Input must be wrapped in the container tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->inputContainerTag(false)
                ->render(),
            'Input container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->inputContainerTag(Block::ARTICLE)
                ->render(),
            'Input must be wrapped in the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render(),
            'Input template must reorder the parts.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->name('value')
                ->render(),
            "'name' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->prefix('Prefix')
                ->render(),
            'Prefix must precede the input.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->render(),
            'Default field markup must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the input.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix must render as '<div>'.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->template('<div>\n{field}\n</div>')
                ->render(),
            'Template must wrap the field.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->value('20')
                ->render(),
            "'value' must be serialized.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->render(),
            "Model 'value' must be serialized.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->render(),
            "'null' 'value' must be omitted.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->value(null)
                ->render(),
            "'value' must be omitted.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->id(null)
                ->input(InputWeek::tag())
                ->render(),
            "'id' and the label 'for' must be omitted.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('weekOfBirth')
                ->input(InputWeek::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
