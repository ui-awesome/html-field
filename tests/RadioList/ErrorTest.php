<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, FormControl\Input\Radio, FormControl\Input\RadioList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorAttributes(['class' => 'value'])
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorClass('value')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget(new BasicForm(), 'agree')
                ->errorContent('Error')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorTag()
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            Error
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorTag(false)
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <span>Error</span>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->errorTag('span')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('agree', 'Error - 1');
        $formModel->addPropertyError('agree', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Agree</label>
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::widget($formModel, 'agree')
                ->input(
                    RadioList::widget()
                        ->items(
                            Radio::widget()->label('No')->value(0),
                            Radio::widget()->label('Yes')->value(1),
                        )
                )
                ->showAllErrors()
                ->render()
        );
    }
}
