<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Color;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputColor;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputColor}.
 */
#[Group('color')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input class="value" id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->attributes(['class' => 'value'])
                ->input(InputColor::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input class="value" id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->class('value')
                ->input(InputColor::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->containerAttributes(['class' => 'value'])
                ->input(InputColor::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->containerClass('value')
                ->input(InputColor::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::DIV)
                ->input(InputColor::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->input(InputColor::tag())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="color">
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::ARTICLE)
                ->input(InputColor::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Color</label>
            <input id="value" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->id('value')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <label for="basicform-color">Color</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="value" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->name('value')
                ->render(),
            "'name' must use the given value.",
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            'Prefix tag must be omitted.',
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render(),
            'Prefix must render as the given tag.',
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->render(),
            'Default structure must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix must render as '<div>'.",
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            'Suffix tag must be omitted.',
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Suffix must render as the given tag.',
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
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
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" value="#000000">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->value('#000000')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('color', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('color')
                ->input(InputColor::tag())
                ->render(),
            "Empty 'string' must omit 'value'.",
        );

        $formModel->setValue('color', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color" value="#000000">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('color')
                ->input(InputColor::tag())
                ->render(),
            "Model value must fill 'value'.",
        );

        // null value
        $formModel->setValue('color', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('color')
                ->input(InputColor::tag())
                ->render(),
            "'null' must omit 'value'.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputColor::tag())
                ->value(null)
                ->render(),
            "'null' must omit 'value'.",
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Color</label>
            <input name="BasicForm[color]" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->id(null)
                ->input(InputColor::tag())
                ->render(),
            "'id' and 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-color">Color</label>
            <input id="basicform-color" type="color">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('color')
                ->input(InputColor::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
