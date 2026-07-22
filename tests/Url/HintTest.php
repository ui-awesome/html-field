<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputUrl};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class HintTest extends \PHPUnit\Framework\TestCase
{
    public function testHint(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->input(InputUrl::tag())->render()
        );
    }

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')
                ->hintAttributes(['class' => 'value'])
                ->input(InputUrl::tag())
                ->render()
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            <div class="value" id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintClass('value')->input(InputUrl::tag())->render()
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url" aria-describedby="basicform-url-help">
            <div id="basicform-url-help">
            Hint
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('url')->hintContent('Hint')->input(InputUrl::tag())->render()
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Block::DIV)->input(InputUrl::tag())->render()
        );
    }

    public function testHintTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            This is a hint.
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(false)->input(InputUrl::tag())->render()
        );
    }

    public function testHintTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint</label>
            <input id="basicform-hint" name="BasicForm[hint]" type="url" aria-describedby="basicform-hint-help">
            <span id="basicform-hint-help">This is a hint.</span>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('hint')->hintTag(Inline::SPAN)->input(InputUrl::tag())->render()
        );
    }
}
