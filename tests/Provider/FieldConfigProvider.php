<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

use UIAwesome\Html\Field\Exception\Message;

/**
 * Data provider for {@see \UIAwesome\Html\Field\Tests\FieldConfigStrictTest} test cases.
 *
 * Provides the form model properties whose field config shape cannot be converted into ordered config calls.
 */
final class FieldConfigProvider
{
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
