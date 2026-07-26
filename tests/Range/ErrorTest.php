<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Range;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputRange;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see InputRange}.
 */
#[Group('range')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->input(InputRange::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(InputRange::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->errorClass('value')
                ->input(InputRange::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('monthOfBirth')
                ->errorContent('Error')
                ->input(InputRange::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->errorTag(Block::DIV)
                ->input(InputRange::tag())
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('monthOfBirth')
                ->errorTag(false)
                ->errorContent('Error')
                ->input(InputRange::tag())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->errorTag(Inline::SPAN)
                ->input(InputRange::tag())
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('monthOfBirth', 'Error - 1');
        $formModel->addError('monthOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-monthofbirth">Month Of Birth</label>
            <input id="basicform-monthofbirth" name="BasicForm[monthOfBirth]" type="range">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('monthOfBirth')
                ->input(InputRange::tag())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
