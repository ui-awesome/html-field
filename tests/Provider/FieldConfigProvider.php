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
