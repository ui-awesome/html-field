<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\File;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\File};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends \PHPUnit\Framework\TestCase
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
            Field::widget(new BasicForm(), 'attachment')
                ->attributes(['class' => 'value'])
                ->input(File::widget())
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')->class('value')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->containerAttributes(['class' => 'value'])
                ->input(File::widget())
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')->containerClass('value')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag()->input(File::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="file">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag('article')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')->id('id')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->inputContainerAttributes(['class' => 'value'])
                ->inputContainerTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->inputContainerClass('value')
                ->inputContainerTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->inputContainerTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget()->multiple())->render()
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
            Field::widget(new BasicForm(), 'attachment')->name('name')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->prefix('Prefix')->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->prefix('prefix')
                ->prefixTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->prefix('prefix')
                ->prefixTag('span')
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->suffix('suffix')->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->suffix('suffix')
                ->suffixTag()
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
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
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            <span>suffix</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->suffix('suffix')
                ->suffixTag('span')
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')
                ->input(File::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->value('my-file.jpg')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('attachment', 'my-file.jpg');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::widget($formModel, 'attachment')->input(File::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('attachment', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-attachment">Attachment</label>
            <input id="basicform-attachment" name="BasicForm[attachment]" type="file">
            </div>
            HTML,
            Field::widget($formModel, 'attachment')->input(File::widget())->render()
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
            Field::widget(new BasicForm(), 'dateOfBirth')->input(File::widget())->value(null)->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->id(null)->render()
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
            Field::widget(new BasicForm(), 'attachment')->input(File::widget())->name(null)->render()
        );
    }
}
