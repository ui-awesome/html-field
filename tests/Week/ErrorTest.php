<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Week;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Form\InputWeek};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('weekOfBirth')->input(InputWeek::tag())->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('weekOfBirth')
                ->errorAttributes(['class' => 'value'])
                ->input(InputWeek::tag())
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('weekOfBirth')->errorClass('value')->input(InputWeek::tag())->render()
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
            Field::tag()->formModel(new BasicForm())->property('weekOfBirth')->errorContent('Error')->input(InputWeek::tag())->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

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
            Field::tag()->formModel($formModel)->property('weekOfBirth')->errorTag(Block::DIV)->input(InputWeek::tag())->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('weekOfBirth')->errorTag(false)->input(InputWeek::tag())->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-weekofbirth">Week Of Birth</label>
            <input id="basicform-weekofbirth" name="BasicForm[weekOfBirth]" type="week">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('weekOfBirth')->errorTag(Inline::SPAN)->input(InputWeek::tag())->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('weekOfBirth', 'Error - 1');
        $formModel->addError('weekOfBirth', 'Error - 2');

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
            Field::tag()->formModel($formModel)->property('weekOfBirth')->input(InputWeek::tag())->showAllErrors()->render()
        );
    }
}
