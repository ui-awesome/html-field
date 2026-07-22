<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class RenderTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input class="value" id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input class="value" id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->class('value')->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerAttributes(['class' => 'value'])->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerClass('value')->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::DIV)->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(false)->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </article>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::ARTICLE)->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Username</label>
            <input id="value" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->id('value')->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->inputContainerClass('value')->inputContainerTag(Block::DIV)->render()
        );
    }

    public function testInputContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->inputContainerTag(Block::DIV)->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </article>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->inputContainerTag(Block::ARTICLE)->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <label for="basicform-username">Username</label>
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->inputTemplate('<div>\n{input}\n{label}\n</div>')->render()
        );
    }

    public function testInvalidClass(): void
    {
        $fieldModel = new BasicForm();

        $fieldModel->addError('username', 'error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input class="value" id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($fieldModel)->property('username')->invalidClass('value')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="name" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->name('name')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->prefix('Prefix')->render()
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->prefix('prefix')->prefixClass('value')->prefixTag(Block::DIV)->render()
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->prefix('prefix')->prefixTag(Block::DIV)->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->prefix('prefix')->prefixTag(false)->render()
        );
    }

    public function testPrefixWithTagValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->prefix('prefix')->prefixTag(Inline::SPAN)->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            suffix
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->suffix('suffix')->suffixClass('value')->suffixTag(Block::DIV)->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->suffix('suffix')->suffixTag(Block::DIV)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->template('<div>\n{field}\n</div>')->render()
        );
    }

    public function testValidClass(): void
    {
        $fieldModel = new BasicForm();

        $fieldModel->setErrors(['username' => []]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input class="value" id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel($fieldModel)->property('username')->validClass('value')->render()
        );
    }

    public function testValidClassWithEmptyValues(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->validClass('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="value">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->value('value')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value.
        $formModel->setValue('username', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('username')->render()
        );

        $formModel->setValue('username', 'samdark');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="samdark">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('username')->render()
        );

        // null value.
        $formModel->setValue('username', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('username')->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Username</label>
            <input name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" type="text">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->name(null)->render()
        );
    }
}
