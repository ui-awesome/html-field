<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputPassword};
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
            <label for="basicform-password">Password</label>
            <input class="value" id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('password')
                ->attributes(['class' => 'value'])
                ->input(InputPassword::tag())
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
            Field::tag()->formModel(new BasicForm())->property('password')->class('value')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->containerAttributes(['class' => 'value'])
                ->input(InputPassword::tag())
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
            Field::tag()->formModel(new BasicForm())->property('password')->containerClass('value')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::DIV)->input(InputPassword::tag())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="password">
            HTML,
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(false)->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('username')->containerTag(Block::ARTICLE)->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->id('id')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->inputContainerClass('value')
                ->inputContainerTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->inputContainerTag(Block::DIV)->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->inputContainerTag(false)->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->inputContainerTag(Block::ARTICLE)->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            Field::tag()->formModel(new BasicForm())->property('password')->name('name')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->prefix('Prefix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->prefix('prefix')
                ->prefixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->suffix('suffix')->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
                ->suffix('suffix')
                ->suffixTag(Block::DIV)
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
            Field::tag()->formModel(new BasicForm())->property('password')
                ->input(InputPassword::tag())
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setValue('password', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->input(InputPassword::tag())->render()
        );

        $formModel->setValue('password', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password" value="#000000">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->input(InputPassword::tag())->render()
        );

        // null value
        $formModel->setValue('password', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password">
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('password')->input(InputPassword::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->value(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->id(null)->render()
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
            Field::tag()->formModel(new BasicForm())->property('password')->input(InputPassword::tag())->name(null)->render()
        );
    }
}
