<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Datetime;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputText;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputText}.
 */
#[Group('datetime')]
final class RenderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->attributes(['class' => 'value'])
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->class('value')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->containerAttributes(['class' => 'value'])
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->containerClass('value')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->containerTag(Block::DIV)
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->containerTag(false)
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            'Container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->containerTag(Block::ARTICLE)
                ->render(),
            'Container must render as the given tag.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->id('value')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <label for="basicform-dateofbirth">Date Of Birth</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="value" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            'Default field structure must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
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
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime" value="1996-12-19T16:39:57-08:00">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->value('1996-12-19T16:39:57-08:00')
                ->render(),
            "'value' must be serialized.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "'value' must be serialized.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "'null' must omit the 'value' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->value(null)
                ->render(),
            "'null' must omit the 'value' attribute.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->id(null)
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->render(),
            "'id' and 'for' must be omitted.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputText::tag()->addAttribute('type', 'datetime'))
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
