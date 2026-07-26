<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Select;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{Optgroup, Option, Select};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see Select}.
 */
#[Group('select')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select class="value" id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->attributes(['class' => 'value'])
                ->input(self::select())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select class="value" id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->class('value')
                ->input(self::select())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerAttributes(['class' => 'value'])
                ->input(self::select())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerClass('value')
                ->input(self::select())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(Block::DIV)
                ->input(self::select())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(false)
                ->input(self::select())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->containerTag(Block::ARTICLE)
                ->input(self::select())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Fruits</label>
            <select id="value" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->id('value')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->inputContainerTag(Block::ARTICLE)
                ->render(),
            'Input container must render as the given tag.',
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            <label for="basicform-fruits">Fruits</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="value">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            prefix
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->prefix('prefix')
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <article>
            prefix
            </article>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->prefix('prefix')
                ->prefixTag(Block::ARTICLE)
                ->render(),
            'Prefix must render as the given tag.',
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->render(),
            'Default layout must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
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
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1" selected>
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->value(1)
                ->render(),
            "'selected' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // int value
        $formModel->setValue('fruits', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1" selected>
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(self::select())
                ->render(),
            "'int' value must select the matching option.",
        );

        // string value
        $formModel->setValue('fruits', '1');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1" selected>
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(self::select())
                ->render(),
            "'string' value must select the matching option.",
        );

        // array value
        $formModel->setValue('fruits', [2, 3]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]" multiple>
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            <option value="2" selected>
            Banana
            </option>
            <option value="3" selected>
            Orange
            </option>
            <option value="4">
            Pineapple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(
                    Select::tag()
                        ->multiple(true)
                        ->options(
                            Option::tag()->content('Select an option'),
                            Option::tag()->content('Apple')->value(1),
                            Option::tag()->content('Banana')->value(2),
                            Option::tag()->content('Orange')->value(3),
                            Option::tag()->content('Pineapple')->value(4),
                        ),
                )
                ->render(),
            'Array value must select multiple options.',
        );

        // value not in items
        $formModel->setValue('fruits', 5);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(self::select())
                ->render(),
            'Unlisted value must select no option.',
        );

        // null value.
        $formModel->setValue('fruits', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(self::select())
                ->render(),
            "'null' must select no option.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->value(null)
                ->render(),
            "'null' must select no option.",
        );
    }

    public function testValueWithOptgroup(): void
    {
        $formModel = new BasicForm();

        $formModel->setValue('fruits', 'cat');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <optgroup label="Pets">
            <option value="dog">
            Dog
            </option>
            <option value="cat" selected>
            Cat
            </option>
            </optgroup>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('fruits')
                ->input(
                    Select::tag()->optgroup(
                        Optgroup::tag()
                            ->label('Pets')
                            ->options(
                                Option::tag()->content('Dog')->value('dog'),
                                Option::tag()->content('Cat')->value('cat'),
                            ),
                    ),
                )
                ->render(),
            'Selected value must propagate to options inside an optgroup.',
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <select name="BasicForm[fruits]">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->id(null)
                ->input(self::select())
                ->render(),
            "'id' and 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits">
            <option>
            Select an option
            </option>
            <option value="1">
            Apple
            </option>
            </select>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->input(self::select())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }

    public function testWithoutPrompt(): void
    {
        $output = Field::tag()
            ->formModel(new BasicForm())
            ->property('fruits')
            ->input(
                Select::tag()->option(
                    Option::tag()->content('Apple')->value(1),
                ),
            )
            ->value(1)
            ->render();

        self::assertStringNotContainsString('Select an option', $output, 'A null prompt must be omitted.');
        self::assertStringContainsString(
            '<option value="1" selected>',
            $output,
            'The matching option must remain selected without a prompt.',
        );
    }

    private static function select(): Select
    {
        return Select::tag()->options(
            Option::tag()->content('Select an option'),
            Option::tag()->content('Apple')->value(1),
        );
    }
}
