<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use PHPForge\Support\Assert;
use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm};

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
            <label for="basicform-username">Username</label>
            <input class="value" id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->attributes(['class' => 'value'])->render()
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
            Field::widget(new BasicForm(), 'username')->class('value')->render()
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
            Field::widget(new BasicForm(), 'username')->containerAttributes(['class' => 'value'])->render()
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
            Field::widget(new BasicForm(), 'username')->containerClass('value')->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag()->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag('article')->render()
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
            Field::widget(new BasicForm(), 'username')->id('value')->render()
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
            Field::widget(new BasicForm(), 'username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->inputContainerClass('value')->inputContainerTag()->render()
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
            Field::widget(new BasicForm(), 'username')->inputContainerTag()->render()
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
            Field::widget(new BasicForm(), 'username')->inputContainerTag(false)->render()
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
            Field::widget(new BasicForm(), 'username')->inputContainerTag('article')->render()
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
            Field::widget(new BasicForm(), 'username')->inputTemplate('<div>\n{input}\n{label}\n</div>')->render()
        );
    }

    public function testInvalidClass(): void
    {
        $fieldModel = new BasicForm();

        $fieldModel->addPropertyError('username', 'error');

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
            Field::widget($fieldModel, 'username')->invalidClass('value')->render()
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
            Field::widget(new BasicForm(), 'username')->name('name')->render()
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
            Field::widget(new BasicForm(), 'username')->prefix('Prefix')->render()
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
            Field::widget(new BasicForm(), 'username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->prefix('prefix')->prefixClass('value')->prefixTag()->render()
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
            Field::widget(new BasicForm(), 'username')->prefix('prefix')->prefixTag()->render()
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
            Field::widget(new BasicForm(), 'username')->prefix('prefix')->prefixTag(false)->render()
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
            Field::widget(new BasicForm(), 'username')->prefix('prefix')->prefixTag('span')->render()
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
            Field::widget(new BasicForm(), 'username')->render()
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
            Field::widget(new BasicForm(), 'username')->suffix('suffix')->render()
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
            Field::widget(new BasicForm(), 'username')
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
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->suffix('suffix')->suffixClass('value')->suffixTag()->render()
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
            Field::widget(new BasicForm(), 'username')->suffix('suffix')->suffixTag()->render()
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
            Field::widget(new BasicForm(), 'username')->template('<div>\n{field}\n</div>')->render()
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
            Field::widget($fieldModel, 'username')->validClass('value')->render()
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
            Field::widget(new BasicForm(), 'username')->validClass('value')->render()
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
            Field::widget(new BasicForm(), 'username')->value('value')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value.
        $formModel->setPropertyValue('username', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::widget($formModel, 'username')->render()
        );

        $formModel->setPropertyValue('username', 'samdark');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="samdark">
            </div>
            HTML,
            Field::widget($formModel, 'username')->render()
        );

        // null value.
        $formModel->setPropertyValue('username', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML,
            Field::widget($formModel, 'username')->render()
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
            Field::widget(new BasicForm(), 'username')->value(null)->render()
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
            Field::widget(new BasicForm(), 'username')->id(null)->render()
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
            Field::widget(new BasicForm(), 'username')->name(null)->render()
        );
    }
}
