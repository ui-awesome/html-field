<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\RadioList;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm, Field\Tests\Support\ChoiceItem, Field\Tests\Support\ChoiceList};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('agree', 'Error');

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
            Field::tag()->formModel($formModel)->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->errorAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->errorClass('value')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
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
            Field::tag()->formModel(new BasicForm())->property('agree')
                ->errorContent('Error')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->errorTag(Block::DIV)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')
                ->errorTag(false)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-agree-w0" name="BasicForm[agree]" type="radio" value="0">
            <label for="basicform-agree-w0">No</label>
            <input id="basicform-agree-w1" name="BasicForm[agree]" type="radio" value="1">
            <label for="basicform-agree-w1">Yes</label>
            </div>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('agree')
                ->errorTag(Inline::SPAN)
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->render()
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
            Field::tag()->formModel($formModel)->property('agree')
                ->input(
                    ChoiceList::radio()
                        ->items(
                            ChoiceItem::radio()->label('No')->value(0),
                            ChoiceItem::radio()->label('Yes')->value(1),
                        )
                )
                ->showAllErrors()
                ->render()
        );
    }
}
