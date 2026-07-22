<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use UIAwesome\Html\{
    Field\Field,
    Field\Tests\Support\BasicForm,
    Field\Tests\Support\ChoiceItem,
    Field\Tests\Support\ChoiceList,
};
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Interop\Inline;

final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('fruits', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorAttributes(['class' => 'value'])
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorClass('value')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
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
            <label>Fruits</label>
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('fruits')
                ->errorContent('Error')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(Block::DIV)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            Error
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(false)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <span>Error</span>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->errorTag(Inline::SPAN)
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->render()
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
            <div>
            <input id="basicform-fruits-w0" name="BasicForm[fruits][]" type="checkbox" value="1">
            <label for="basicform-fruits-w0">Apple</label>
            <input id="basicform-fruits-w1" name="BasicForm[fruits][]" type="checkbox" value="2">
            <label for="basicform-fruits-w1">Banana</label>
            <input id="basicform-fruits-w2" name="BasicForm[fruits][]" type="checkbox" value="3">
            <label for="basicform-fruits-w2">Orange</label>
            </div>
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()->formModel($formModel)->property('fruits')
                ->input(
                    ChoiceList::checkbox()
                        ->items(
                            ChoiceItem::checkbox()->label('Apple')->value(1),
                            ChoiceItem::checkbox()->label('Banana')->value(2),
                            ChoiceItem::checkbox()->label('Orange')->value(3),
                        )
                )
                ->showAllErrors()
                ->render()
        );
    }
}
