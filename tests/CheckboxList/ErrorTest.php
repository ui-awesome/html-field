<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\{
    Field\Field,
    Field\Tests\Support\BasicForm,
    FormControl\Input\Checkbox,
    FormControl\Input\CheckboxList,
};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ErrorTest extends \PHPUnit\Framework\TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->errorAttributes(['class' => 'value'])
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->errorClass('value')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
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
            Field::widget(new BasicForm(), 'fruits')
                ->errorContent('Error')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->errorTag()
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->errorTag(false)
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error');

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
            Field::widget($formModel, 'fruits')
                ->errorTag('span')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->render()
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addPropertyError('fruits', 'Error - 1');
        $formModel->addPropertyError('fruits', 'Error - 2');

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
            Field::widget($formModel, 'fruits')
                ->input(
                    CheckboxList::widget()
                        ->items(
                            Checkbox::widget()->label('Apple')->value(1),
                            Checkbox::widget()->label('Banana')->value(2),
                            Checkbox::widget()->label('Orange')->value(3),
                        )
                )
                ->showAllErrors()
                ->render()
        );
    }
}
