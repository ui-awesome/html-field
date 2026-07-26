<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

use UIAwesome\Html\Field\Exception\Message;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\ConfigForm;
use UIAwesome\Html\Form\TextArea;

/**
 * Data provider for {@see \UIAwesome\Html\Field\Tests\FieldConfigStrictTest} test cases.
 *
 * Provides the form model properties whose field config shape cannot be converted into ordered config calls.
 */
final class FieldConfigProvider
{
    /**
     * @return iterable<string, array{string, string, string}>
     */
    public static function bindingOverrides(): iterable
    {
        yield 'checked' => [
            'overrideChecked',
            'checkbox',
            <<<HTML
            <div>
            <input id="configform-overridechecked" name="ConfigForm[overrideChecked]" type="checkbox" checked>
            <label for="configform-overridechecked">Override Checked</label>
            </div>
            HTML,
        ];
        yield 'id' => [
            'overrideId',
            'text',
            <<<HTML
            <div>
            <label for="custom-id">Override Id</label>
            <input id="custom-id" name="ConfigForm[overrideId]" type="text">
            </div>
            HTML,
        ];
        yield 'name' => [
            'overrideName',
            'text',
            <<<HTML
            <div>
            <label for="configform-overridename">Override Name</label>
            <input id="configform-overridename" name="custom-name" type="text">
            </div>
            HTML,
        ];
        yield 'placeholder' => [
            'overridePlaceholder',
            'text',
            <<<HTML
            <div>
            <label for="configform-overrideplaceholder">Override Placeholder</label>
            <input id="configform-overrideplaceholder" name="ConfigForm[overridePlaceholder]" type="text" placeholder="Custom placeholder.">
            </div>
            HTML,
        ];
        yield 'value' => [
            'overrideValue',
            'text',
            <<<HTML
            <div>
            <label for="configform-overridevalue">Override Value</label>
            <input id="configform-overridevalue" name="ConfigForm[overrideValue]" type="text" value="custom-value">
            </div>
            HTML,
        ];
    }

    /**
     * @return iterable<string, array{callable(ConfigForm): Field}>
     */
    public static function replacementControlOrders(): iterable
    {
        yield 'control after property' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->formModel($form)
                ->property('textArea')
                ->control('textarea'),
        ];
        yield 'control before form model' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->control('textarea')
                ->formModel($form)
                ->property('textArea'),
        ];
        yield 'control between form model and property' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->formModel($form)
                ->control('textarea')
                ->property('textArea'),
        ];
        yield 'input after property' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->formModel($form)
                ->property('textArea')
                ->input(TextArea::tag()),
        ];
        yield 'input before form model' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->input(TextArea::tag())
                ->formModel($form)
                ->property('textArea'),
        ];
        yield 'property before form model' => [
            static fn(ConfigForm $form): Field => Field::tag()
                ->control('textarea')
                ->property('textArea')
                ->formModel($form),
        ];
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function unsupportedShapes(): iterable
    {
        yield 'empty method name' => [
            'emptyMethodName',
            Message::FIELD_CONFIG_METHOD_NAME_INVALID->getMessage('emptyMethodName'),
        ];
        yield 'named arguments' => [
            'namedArguments',
            Message::FIELD_CONFIG_ARGUMENTS_NOT_POSITIONAL->getMessage('class', 'namedArguments'),
        ];
        yield 'non-string method name' => [
            'nonStringMethodName',
            Message::FIELD_CONFIG_METHOD_NAME_INVALID->getMessage('nonStringMethodName'),
        ];
    }
}
