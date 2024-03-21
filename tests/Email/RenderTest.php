<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Email;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Email};

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
            <label for="basicform-email">Email</label>
            <input class="value" id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')->attributes(['class' => 'value'])->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')->class('value')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')
                ->containerAttributes(['class' => 'value'])
                ->input(Email::widget())
                ->render()
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
            Field::widget(new BasicForm(), 'email')->containerClass('value')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag()->input(Email::widget())->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="email">
            HTML,
            Field::widget(new BasicForm(), 'username')->containerTag(false)->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'username')->containerTag('article')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')->id('id')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->inputContainerTag()
                ->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->inputContainerTag(false)
                ->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->inputContainerTag('article')
                ->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->inputTemplate('<div>\n{input}\n{label}\n</div>')
                ->render()
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
            Field::widget(new BasicForm(), 'email')->name('name')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->prefix('Prefix')->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <article>
            prefix
            </article>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->prefix('prefix')
                ->prefixTag('article')
                ->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->suffix('suffix')->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <div>
            suffix
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            suffix
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
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
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            <article>
            suffix
            </article>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->suffix('suffix')
                ->suffixTag('article')
                ->render()
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
            Field::widget(new BasicForm(), 'email')
                ->input(Email::widget())
                ->template('<div>\n{field}\n</div>')
                ->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->value('#000000')->render()
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new BasicForm();

        // string value
        $formModel->setPropertyValue('email', '');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget($formModel, 'email')->input(Email::widget())->render()
        );

        $formModel->setPropertyValue('email', '#000000');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email" value="#000000">
            </div>
            HTML,
            Field::widget($formModel, 'email')->input(Email::widget())->render()
        );

        // null value
        $formModel->setPropertyValue('email', null);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            HTML,
            Field::widget($formModel, 'email')->input(Email::widget())->render()
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
            Field::widget(new BasicForm(), 'dateOfBirth')->input(Email::widget())->value(null)->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->id(null)->render()
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
            Field::widget(new BasicForm(), 'email')->input(Email::widget())->name(null)->render()
        );
    }
}
