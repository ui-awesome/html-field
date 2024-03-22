<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Week};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->input(Week::widget())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(Week::widget())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->errorClass('value')->input(Week::widget())->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'weekOfBirth')->errorContent('Error')->input(Week::widget())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->errorTag()->input(Week::widget())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            Error
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->errorTag(false)->input(Week::widget())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->errorTag('span')->input(Week::widget())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('weekOfBirth', 'Error - 1');
        $formModel->addPropertyError('weekOfBirth', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'weekOfBirth')->input(Week::widget())->showAllErrors()->render()
        );
    }
}
