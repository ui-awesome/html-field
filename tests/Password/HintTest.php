<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Password;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Password};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class HintTest extends \PHPUnit\Framework\TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->input(Password::widget())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')
                ->hintAttributes(['class' => 'value'])
                ->input(Password::widget())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintClass('value')->input(Password::widget())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-password">Password</label>
            <input id="basicform-password" name="BasicForm[password]" type="password" aria-describedby="basicform-password-help">
            <div id="basicform-password-help">
            Hint
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'password')->hintContent('Hint')->input(Password::widget())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag()->input(Password::widget())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag(false)->input(Password::widget())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="password" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'hint')->hintTag('span')->input(Password::widget())->render()
        );
    }
}
