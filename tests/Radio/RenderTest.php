<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputRadio}.
 */
#[Group('radio')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->attributes(['class' => 'value'])
                ->input(InputRadio::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->class('value')
                ->input(InputRadio::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(InputRadio::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerClass('value')
                ->input(InputRadio::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::DIV)
                ->input(InputRadio::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(false)
                ->input(InputRadio::tag())
                ->render(),
            'Container must be omitted.',
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::ARTICLE)
                ->input(InputRadio::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="value" name="BasicForm[agree]" type="radio">
            <label for="value">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id('value')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->inputContainerTag(Block::DIV)
                ->render(),
            'Input must be wrapped in the container tag.',
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->inputContainerTag(Block::ARTICLE)
                ->render(),
            'Input container must render as the given tag.',
        );
    }

    public function testInputContainerWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->inputContainerTag(false)
                ->render(),
            'Input container must be omitted.',
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-agree">Agree</label>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->inputTemplate('<div>\n{label}\n{input}\n</div>')
                ->render(),
            'Input template must reorder the parts.',
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="value" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
                ->render(),
            "Prefix must render as '<div>'.",
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render(),
            'Prefix must render as the given tag.',
        );
    }

    public function testPrefixWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            'Prefix tag must be omitted.',
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->render(),
            'Default layout must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
                ->render(),
            "Suffix must render as '<div>'.",
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Suffix must render as the given tag.',
        );
    }

    public function testSuffixWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            'Suffix tag must be omitted.',
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag()->value('ok'))
                ->value('ok')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testValueDoesNotReplaceTheOptionValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="yes">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag()->value('yes'))
                ->value('no')
                ->render(),
            "The field selection must not replace the radio's option value.",
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value(true))
                ->render(),
            "'false' must not check the input.",
        );

        $formModel->setValue('agree', true);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value(true))
                ->render(),
            "'true' must check the input.",
        );

        // int value
        $formModel->setValue('agree', 0);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value(1))
                ->render(),
            "Value '0' must not check the input.",
        );

        $formModel->setValue('agree', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value(1))
                ->render(),
            "Value '1' must check the input.",
        );

        // string value
        $formModel->setValue('agree', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value('ok'))
                ->render(),
            "Empty 'string' must not check the input.",
        );

        $formModel->setValue('agree', 'ok');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value('ok'))
                ->render(),
            "Matching 'string' must check the input.",
        );

        // null value
        $formModel->setValue('agree', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="ok">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag()->value('ok'))
                ->render(),
            "'null' must not check the input.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())
                ->value(null)
                ->render(),
            "'null' must omit the 'value' attribute.",
        );
    }

    public function testValueWithoutUncheckedCompanion(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag()->value(1))
                ->render(),
            'No hidden companion must be rendered.',
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="BasicForm[agree]" type="radio">
            <label>Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id(null)
                ->input(InputRadio::tag())
                ->render(),
            "'id' and 'for' must be omitted.",
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputRadio::tag())->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
