<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Checkbox;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputCheckbox;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputCheckbox}.
 */
#[Group('checkbox')]
final class RenderTest extends TestCase
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->attributes(['class' => 'value'])
                ->input(InputCheckbox::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->class('value')
                ->input(InputCheckbox::tag())
                ->render(),
            "'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerAttributes(['class' => 'value'])
                ->input(InputCheckbox::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerClass('value')
                ->input(InputCheckbox::tag())
                ->render(),
            "Container 'class' must be serialized.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(Block::ARTICLE)
                ->input(InputCheckbox::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->containerTag(false)
                ->input(InputCheckbox::tag())
                ->render(),
            'Container must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->id('value')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <label for="basicform-agree">Agree</label>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
                ->inputContainerTag(Block::DIV)
                ->inputTemplate('{label}\n{input}')
                ->render(),
            'Input template must reorder the parts.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
                ->render(),
            'Default structure must be rendered.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
                ->prefix('prefix')
                ->suffix('suffix')
                ->template('{field}')
                ->render(),
            'Template must render only the field part.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag()->value('ok'))
                ->value('ok')
                ->render(),
            "'value' and 'checked' must be serialized.",
        );
    }

    public function testValueDoesNotReplaceTheOptionValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="yes">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag()->value('yes'))
                ->value('no')
                ->render(),
            "The field selection must not replace the checkbox's option value.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value(true))
                ->render(),
            "'false' must not set 'checked'.",
        );

        $formModel->setValue('agree', true);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value(true))
                ->render(),
            "'true' must set 'checked'.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value(1))
                ->render(),
            "'0' must not set 'checked'.",
        );

        $formModel->setValue('agree', 1);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value(1))
                ->render(),
            "'1' must set 'checked'.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value('ok'))
                ->render(),
            "Empty 'string' must not set 'checked'.",
        );

        $formModel->setValue('agree', 'ok');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="ok" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value('ok'))
                ->render(),
            "Matching 'string' must set 'checked'.",
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
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputCheckbox::tag()->value('ok'))
                ->render(),
            "'null' must not set 'checked'."
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" value="1">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->input(InputCheckbox::tag()->value(1))
                ->render(),
            'Hidden companion input must be omitted.',
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputCheckbox::tag())
                ->id(null)
                ->render(),
            "'id' and 'for' must be omitted.",
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
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputCheckbox::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
