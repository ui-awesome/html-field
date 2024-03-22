<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Password};

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
            <label for="basicform-password">Password</label>
            <input class="value" id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->attributes(['class' => 'value'])
                ->input(Password::widget())
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input class="value" id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->class('value')->input(Password::widget())->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->containerAttributes(['class' => 'value'])
                ->input(Password::widget())
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->containerClass('value')->input(Password::widget())->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag()->input(Password::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="password">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->input(Password::widget())->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="password">
            </article>
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag('article')->input(Password::widget())->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="id">Password</label>
            <input id="id" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->id('id')->input(Password::widget())->render()
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->inputContainerTag()->render()
        );
    }

    public function testInputContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->inputContainerTag(false)->render()
        );
    }

    public function testInputContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->inputContainerTag('article')->render()
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <label for="basicform-password">Password</label>
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="name" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->name('name')->input(Password::widget())->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Prefix
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->prefix('Prefix')->render()
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->suffix('suffix')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')
                ->input(Password::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password" value="#000000">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('password', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget($formModel, 'password')->input(Password::widget())->render()
        );

        $formModel->setPropertyValue('password', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password" value="#000000">
            </div>
            HTML,
            Field::widget($formModel, 'password')->input(Password::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('password', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget($formModel, 'password')->input(Password::widget())->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Password</label>
            <input name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" type="password">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->input(Password::widget())->name(null)->render()
        );
    }
}
