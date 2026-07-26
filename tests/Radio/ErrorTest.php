<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Radio;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} error rendering with {@see InputRadio}.
 */
#[Group('radio')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorAttributes(['class' => 'value'])
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorClass('value')
                ->input(InputRadio::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->errorContent('Error')
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(Block::DIV)
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(false)
                ->input(InputRadio::tag())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagwithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <article>
            Error
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->errorTag(Block::ARTICLE)
                ->input(InputRadio::tag())
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
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('agree')
                ->input(InputRadio::tag())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
