<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\{ChoiceItem, RadioList};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see RadioList}.
 */
#[Group('radiolist')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(self::radioList())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorAttributes(['class' => 'value'])
                ->input(self::radioList())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorClass('value')
                ->input(self::radioList())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->errorContent('Error')
                ->input(self::radioList())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(Block::DIV)
                ->input(self::radioList())
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(false)
                ->input(self::radioList())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(Inline::SPAN)
                ->input(self::radioList())
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error - 1');
        $formModel->addError('agree', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div id="basicform-agree">
            <input id="basicform-agree-0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-0">No</label>
            <input id="basicform-agree-1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-1">Yes</label>
            </div>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(self::radioList())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }

    private static function radioList(): RadioList
    {
        return RadioList::tag()->items(
            ChoiceItem::tag()->label('No')->value(0),
            ChoiceItem::tag()->label('Yes')->value(1),
        );
    }
}
