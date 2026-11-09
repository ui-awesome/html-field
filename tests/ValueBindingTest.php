<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\ValueBindingProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, ConfigForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem, InputCheckbox, InputRadio, InputText, Option, RadioList, Select, TextArea};

/**
 * Unit tests for explicit field values, model fallback, and immutable control binding.
 */
#[Group('field')]
final class ValueBindingTest extends TestCase
{
    #[DataProviderExternal(ValueBindingProvider::class, 'listValues')]
    public function testCheckboxListValues(
        mixed $modelValue,
        bool $configured,
        mixed $value,
        string $yesChecked,
        string $zeroChecked,
    ): void {
        $model = new BasicForm();

        $model->fruits = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('fruits')
            ->input(CheckboxList::tag()->checked(true)->items(
                ChoiceItem::tag()->value('yes')->label('Yes'),
                ChoiceItem::tag()->value(0)->label('Zero'),
            ));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits][]" type="checkbox" value="yes"{$yesChecked}>
            <label for="basicform-fruits-0">Yes</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits][]" type="checkbox" value="0"{$zeroChecked}>
            <label for="basicform-fruits-1">Zero</label>
            </div>
            </div>
            HTML,
            $field->render(),
            'Checkbox list binding must replace its prior selection and retain item values.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'checkedValues')]
    public function testCheckboxValues(
        mixed $modelValue,
        int|string $option,
        bool $configured,
        mixed $value,
        string $optionValue,
        string $checked,
    ): void {
        $model = new BasicForm();

        $model->agree = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('agree')
            ->input(InputCheckbox::tag()->value($option)->checked(true));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox"{$optionValue}{$checked}>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            $field->render(),
            'Checkbox binding must replace a prior selection without erasing the option value.',
        );
    }

    public function testExplicitNullClearsAPriorTextAreaValueAttribute(): void
    {
        $model = new BasicForm();

        $model->content = 'model-value';

        $input = TextArea::tag()->attributes(['value' => 'previous']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">\n</textarea>
            </div>
            HTML,
            Field::tag()->formModel($model)->property('content')->input($input)->value(null)->render(),
            'Explicit null must also remove the supplied control value attribute.',
        );
        self::assertSame(
            'previous',
            $input->getAttribute('value'),
            'The supplied control must remain unchanged.',
        );
    }

    public function testFinalModelConfigOverridesExplicitNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-overridevalue">Override Value</label>
            <input id="configform-overridevalue" name="ConfigForm[overrideValue]" type="text" value="custom-value">
            </div>
            HTML,
            Field::tag()->formModel(new ConfigForm())->property('overrideValue')->value(null)->render(),
            'Final model config must retain precedence over an explicit null field value.',
        );
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="configform-overridechecked" name="ConfigForm[overrideChecked]" type="checkbox" checked>
            <label for="configform-overridechecked">Override Checked</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new ConfigForm())
                ->property('overrideChecked')
                ->control('checkbox')
                ->value(null)
                ->render(),
            'Final checked config must retain precedence over an explicit null field selection.',
        );
    }

    public function testNullClearsAPreselectedCheckboxWithoutAnOptionValue(): void
    {
        $model = new BasicForm();

        $model->agree = 'model-value';

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('agree')
                ->input(InputCheckbox::tag()->checked(true))
                ->value(null)
                ->render(),
            'Explicit null must clear a prior selection without inventing an option value.',
        );
    }

    public function testNullClearsAPreselectedRadioWithoutAnOptionValue(): void
    {
        $model = new BasicForm();

        $model->agree = 'model-value';

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('agree')
                ->input(InputRadio::tag()->checked(true))
                ->value(null)
                ->render(),
            'Explicit null must clear a prior selection without inventing an option value.',
        );
    }

    public function testOmittedValuePreservesAPreselectedCheckboxWithoutAnOptionValue(): void
    {
        $model = new BasicForm();

        $model->agree = null;

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('agree')
                ->input(InputCheckbox::tag()->checked(true))
                ->render(),
            'Omitting value() must preserve prior checked state when the model has no value or option.',
        );
    }

    public function testOmittedValuePreservesAPreselectedRadioWithoutAnOptionValue(): void
    {
        $model = new BasicForm();

        $model->agree = null;

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio" checked>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel($model)
                ->property('agree')
                ->input(InputRadio::tag()->checked(true))
                ->render(),
            'Omitting value() must preserve prior checked state when the model has no value or option.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'listValues')]
    public function testRadioListValues(
        mixed $modelValue,
        bool $configured,
        mixed $value,
        string $yesChecked,
        string $zeroChecked,
    ): void {
        $model = new BasicForm();

        $model->fruits = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('fruits')
            ->input(RadioList::tag()->checked(true)->items(
                ChoiceItem::tag()->value('yes')->label('Yes'),
                ChoiceItem::tag()->value(0)->label('Zero'),
            ));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Fruits</label>
            <div id="basicform-fruits">
            <input id="basicform-fruits-0" name="BasicForm[fruits]" type="radio" value="yes"{$yesChecked}>
            <label for="basicform-fruits-0">Yes</label>
            <input id="basicform-fruits-1" name="BasicForm[fruits]" type="radio" value="0"{$zeroChecked}>
            <label for="basicform-fruits-1">Zero</label>
            </div>
            </div>
            HTML,
            $field->render(),
            'Radio list binding must replace its prior selection and retain item values.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'checkedValues')]
    public function testRadioValues(
        mixed $modelValue,
        int|string $option,
        bool $configured,
        mixed $value,
        string $optionValue,
        string $checked,
    ): void {
        $model = new BasicForm();

        $model->agree = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('agree')
            ->input(InputRadio::tag()->value($option)->checked(true));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="radio"{$optionValue}{$checked}>
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            $field->render(),
            'Radio binding must replace a prior selection without erasing the option value.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'selectValues')]
    public function testSelectValues(
        mixed $modelValue,
        bool $configured,
        mixed $value,
        string $yesSelected,
        string $zeroSelected,
        string $emptySelected,
    ): void {
        $model = new BasicForm();

        $model->fruits = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('fruits')
            ->input(Select::tag()->value('yes')->options(
                Option::tag()->value('yes')->content('Yes')->selected(true),
                Option::tag()->value(0)->content('Zero'),
                Option::tag()->value('')->content('Empty'),
            ));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-fruits">Fruits</label>
            <select id="basicform-fruits" name="BasicForm[fruits]">
            <option value="yes"{$yesSelected}>\nYes\n</option>
            <option value="0"{$zeroSelected}>\nZero\n</option>
            <option{$emptySelected}>\nEmpty\n</option>
            </select>
            </div>
            HTML,
            $field->render(),
            'Select binding must replace both prior select state and option defaults.',
        );
    }

    #[TestWith([false, '&lt;b&gt;&amp;prior&lt;/b&gt;'])]
    #[TestWith([true, '<b>&prior</b>'])]
    public function testTextAreaExplicitNullClearsPriorContent(bool $raw, string $prior): void
    {
        $model = new BasicForm();

        $model->content = 'model-value';

        $input = TextArea::tag()
            ->rows(3)
            ->attributes(['value' => 'previous']);

        $input = $raw ? $input->html('<b>&prior</b>') : $input->content('<b>&prior</b>');

        $original = Field::tag()
            ->formModel($model)
            ->property('content')
            ->input($input);

        $selected = $original->value('override');
        $cleared = $selected->value(null);

        $copy = clone $cleared;

        $empty = <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]" rows="3">\n</textarea>
            </div>
            HTML;
        $populated = <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]" value="previous" rows="3">{$prior}model-value</textarea>
            </div>
            HTML;
        $overridden = <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]" value="override" rows="3">{$prior}override</textarea>
            </div>
            HTML;

        self::assertNotSame(
            $original,
            $selected,
            'Assigning a textarea value must clone the field.',
        );
        self::assertNotSame(
            $selected,
            $cleared,
            'Clearing a textarea value must clone the field.',
        );

        Assert::equalsWithoutLE(
            $empty,
            $cleared->render(),
            'Explicit null must clear prior content and value attributes.',
        );
        Assert::equalsWithoutLE(
            $empty,
            $copy->render(),
            'A native clone must retain cleared textarea state.',
        );
        Assert::equalsWithoutLE(
            $overridden,
            $selected->render(),
            'Clearing a clone must preserve explicit string binding.',
        );
        Assert::equalsWithoutLE(
            $populated,
            $original->render(),
            'Clearing a clone must preserve model fallback.',
        );
        Assert::equalsWithoutLE(
            $empty,
            $cleared->render(),
            'Repeated rendering must retain empty textarea content.',
        );
        Assert::equalsWithoutLE(
            $populated,
            $original->render(),
            'Repeated fallback must not accumulate model content.',
        );
        Assert::equalsWithoutLE(
            '<textarea value="previous" rows="3">' . $prior . '</textarea>',
            $input->render(),
            'Binding must preserve the supplied textarea content and attributes.',
        );

        self::assertSame(
            'model-value',
            $model->content,
            'Clearing textarea content must not change the model.',
        );
        self::assertNull(
            $cleared->getAttribute('value'),
            'The field must keep explicit-null state outside attributes.',
        );
    }

    public function testTextAreaFinalModelContentOverridesExplicitNull(): void
    {
        $model = new ConfigForm();

        $input = TextArea::tag()
            ->content('previous encoded')
            ->html('<b>previous raw</b>');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-overridecontent">Override Content</label>
            <textarea id="configform-overridecontent" name="ConfigForm[overrideContent]">&lt;b&gt;configured &amp; content&lt;/b&gt;</textarea>
            </div>
            HTML,
            Field::tag()->formModel($model)->property('overrideContent')->input($input)->value(null)->render(),
            'Final model content configuration must apply after prior content is cleared.',
        );
        self::assertSame(
            'model-content',
            $model->overrideContent,
            'Final configuration must not change model content.',
        );
    }

    public function testTextAreaOmittedValuePreservesContentWithANullModel(): void
    {
        $model = new BasicForm();

        $model->content = null;

        $input = TextArea::tag()
            ->content('<b>encoded</b>')
            ->html('<i>raw</i>');
        $field = Field::tag()
            ->formModel($model)
            ->property('content')
            ->input($input);

        $expected = <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]">&lt;b&gt;encoded&lt;/b&gt;<i>raw</i></textarea>
            </div>
            HTML;

        Assert::equalsWithoutLE(
            $expected,
            $field->render(),
            'Omitted values must retain prior encoded and raw content.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $field->render(),
            'Repeated rendering must preserve prior content.',
        );
        self::assertNull(
            $model->content,
            'Rendering must preserve the null model value.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'textAreaValues')]
    public function testTextAreaValues(
        mixed $modelValue,
        bool $configured,
        mixed $value,
        string $attributes,
        string $content,
    ): void {
        $model = new BasicForm();

        $model->content = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('content')
            ->control('textarea');

        $content = $content === '' ? "\n" : $content;

        if ($configured) {
            $field = $field->value($value);
        } else {
            $attributes = '';
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-content">Content</label>
            <textarea id="basicform-content" name="BasicForm[content]"{$attributes}>{$content}</textarea>
            </div>
            HTML,
            $field->render(),
            'Textarea binding must preserve its string-content and explicit attribute contracts.',
        );
    }

    #[DataProviderExternal(ValueBindingProvider::class, 'textValues')]
    public function testTextValues(mixed $modelValue, bool $configured, mixed $value, string $attributes): void
    {
        $model = new BasicForm();

        $model->username = $modelValue;

        $field = Field::tag()
            ->formModel($model)
            ->property('username')
            ->input(InputText::tag()->value('previous'));

        if ($configured) {
            $field = $field->value($value);
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text"{$attributes}>
            </div>
            HTML,
            $field->render(),
            'Text binding must replace a prior control value without losing explicit falsy values.',
        );
    }

    public function testValueClonesAndRepeatedRendersRemainIndependent(): void
    {
        $model = new BasicForm();

        $model->username = 'model-value';

        $input = InputText::tag()->value('previous');
        $original = Field::tag()
            ->formModel($model)
            ->property('username')
            ->input($input);

        $selected = $original->value('override');
        $cleared = $selected->value(null);

        $copy = clone $cleared;

        $populated = <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="model-value">
            </div>
            HTML;
        $overridden = <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text" value="override">
            </div>
            HTML;
        $empty = <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            </div>
            HTML;

        self::assertNotSame(
            $original,
            $selected,
            'Value assignment must clone the field.',
        );
        self::assertNotSame(
            $selected,
            $cleared,
            'Null assignment must clone the field.',
        );
        Assert::equalsWithoutLE(
            $empty,
            $copy->render(),
            'Native cloning must retain explicit-null state.',
        );
        Assert::equalsWithoutLE(
            $empty,
            $cleared->render(),
            'Null must clear a previous explicit override.',
        );
        Assert::equalsWithoutLE(
            $overridden,
            $selected->render(),
            'Clearing a clone must not change its source.',
        );
        Assert::equalsWithoutLE(
            $populated,
            $original->render(),
            'The untouched field must retain model fallback.',
        );
        Assert::equalsWithoutLE(
            $empty,
            $cleared->render(),
            'Repeated rendering must retain explicit-null state.',
        );
        Assert::equalsWithoutLE(
            $populated,
            $original->render(),
            'Repeated rendering must not mutate fallback.',
        );
        self::assertSame(
            'previous',
            $input->getAttribute('value'),
            'Rendering must not mutate the supplied input.',
        );
        self::assertSame(
            'model-value',
            $model->username,
            'Field overrides must not write to the model.',
        );
        self::assertNull(
            $cleared->getAttribute('value'),
            'Selected state must remain outside field attributes.',
        );
    }
}
