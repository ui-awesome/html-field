<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\File;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} rendering with {@see InputFile}.
 */
#[Group('file')]
final class RenderTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input class="value" id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->attributes(['class' => 'value'])
                ->input(InputFile::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input class="value" id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->class('value')
                ->input(InputFile::tag())
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->containerAttributes(['class' => 'value'])
                ->input(InputFile::tag())
                ->render(),
            "Container 'class' must be serialized.",
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->containerClass('value')
                ->input(InputFile::tag())
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
            <input id="basicform-username" name="BasicForm[username]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::DIV)
                ->input(InputFile::tag())
                ->render(),
            "Container must render as '<div>'.",
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="file">
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->input(InputFile::tag())
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
            <input id="basicform-username" name="BasicForm[username]" type="file">
            </article>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(Block::ARTICLE)
                ->input(InputFile::tag())
                ->render(),
            'Container must render as the given tag.',
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="id">Attachment</label>
            <input id="id" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->id('id')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
                ->inputContainerTag(Block::DIV)
                ->render(),
            'Input must be wrapped in the container tag.',
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <label for="basicform-attachment">Attachment</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render(),
            'Input template must reorder the parts.',
        );
    }

    public function testMultiple(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment][]" type="file" multiple>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag()
                ->multiple(true))
                ->render(),
            "'multiple' and array 'name' must be serialized.",
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="name" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->name('name')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
                ->render(),
            'Default field structure must be rendered.',
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            suffix
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <span>suffix</span>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
                ->value('my-file.jpg')
                ->render(),
            "'value' must be omitted for file input.",
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('attachment', 'my-file.jpg');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->input(InputFile::tag())
                ->render(),
            "'value' must be omitted for file input.",
        );

        // null value
        $formModel->setValue('attachment', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('attachment')
                ->input(InputFile::tag())
                ->render(),
            "'value' must be omitted for file input.",
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->input(InputFile::tag())
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
            <label>Attachment</label>
            <input name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" type="file">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('attachment')
                ->input(InputFile::tag())
                ->name(null)
                ->render(),
            "'name' must be omitted.",
        );
    }
}
