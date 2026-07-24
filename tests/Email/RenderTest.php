<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputEmail;
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} rendering with {@see InputEmail}.
 */
#[Group('email')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input class="value" id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->attributes(['class' => 'value'])
                ->input(InputEmail::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input class="value" id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->class('value')
                ->input(InputEmail::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->containerAttributes(['class' => 'value'])
                ->input(InputEmail::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->containerClass('value')
                ->input(InputEmail::tag())
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
            <input id="basicform-username" name="BasicForm[username]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::DIV)
                ->input(InputEmail::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="email">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->input(InputEmail::tag())
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
            <input id="basicform-username" name="BasicForm[username]" type="email">
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::ARTICLE)
                ->input(InputEmail::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="id">Email</label>
            <input id="id" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->id('id')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <label for="basicform-email">Email</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="name" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->name('name')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
                ->render(),
            'Default field structure must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <article>
            suffix
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
                ->suffix('suffix')
                ->suffixTag(Block::ARTICLE)
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email" value="#000000">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
                ->value('#000000')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('email', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('email')
                ->input(InputEmail::tag())
                ->render(),
            "Empty 'string' must omit the 'value' attribute.",
        );

        $formModel->setValue('email', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email" value="#000000">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('email')
                ->input(InputEmail::tag())
                ->render(),
            "'value' must be serialized.",
        );

        // null value
        $formModel->setValue('email', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('email')
                ->input(InputEmail::tag())
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
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputEmail::tag())
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
            <label>Email</label>
            <input name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" type="email">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->input(InputEmail::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
