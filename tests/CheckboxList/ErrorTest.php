<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see CheckboxList}.
 */
#[Group('checkboxlist')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorAttributes(['class' => 'value'])
                ->input(self::checkboxList())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorClass('value')
                ->input(self::checkboxList())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('fruits')
                ->errorContent('Error')
                ->input(self::checkboxList())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(Block::DIV)
                ->input(self::checkboxList())
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(false)
                ->input(self::checkboxList())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(Inline::SPAN)
                ->input(self::checkboxList())
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('fruits', 'Error - 1');
        $formModel->addError('fruits', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-0">Apple</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-1">Banana</label>
            <input id="basicform-fruits-2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-2">Orange</label>
            </div>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(self::checkboxList())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }

    private static function checkboxList(): CheckboxList
    {
        return CheckboxList::tag()->items(
            ChoiceItem::tag()->label('Apple')->value(1),
            ChoiceItem::tag()->label('Banana')->value(2),
            ChoiceItem::tag()->label('Orange')->value(3),
        );
    }
}
