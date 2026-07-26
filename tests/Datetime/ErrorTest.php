<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Datetime;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputText;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see InputText}.
 */
#[Group('datetime')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->errorClass('value')
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('dateOfBirth')
                ->errorContent('Error')
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->errorTag(Block::DIV)
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->errorTag(false)
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->errorTag(Inline::SPAN)
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('dateOfBirth', 'Error - 1');
        $formModel->addError('dateOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-dateofbirth">Date Of Birth</label>
            <input id="basicform-dateofbirth" name="BasicForm[dateOfBirth]" type="datetime">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('dateOfBirth')
                ->input(InputText::tag()
                ->addAttribute('type', 'datetime'))
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
