<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

/**
 * Provides explicit value and selection cases for {@see \UIAwesome\Html\Field\Tests\ValueBindingTest}.
 */
final class ValueBindingProvider
{
    /**
     * @return iterable<string, array{mixed, mixed, bool, mixed, string, string}>
     */
    public static function checkedValues(): iterable
    {
        yield 'empty model, explicit null' => [
            null,
            'yes',
            true,
            null,
            ' value="yes"',
            '',
        ];
        yield 'empty model, omitted value' => [
            null,
            'yes',
            false,
            null,
            ' value="yes"',
            '',
        ];
        yield 'empty option matches empty string' => [
            'yes',
            '',
            true,
            '',
            '',
            ' checked',
        ];
        yield 'populated model, empty array' => [
            'yes',
            'yes',
            true,
            [],
            ' value="yes"',
            '',
        ];
        yield 'populated model, empty string' => [
            'yes',
            'yes',
            true,
            '',
            ' value="yes"',
            '',
        ];
        yield 'populated model, explicit null' => [
            'yes',
            'yes',
            true,
            null,
            ' value="yes"',
            ''
        ];
        yield 'populated model, false' => [
            'yes',
            'yes',
            true,
            false,
            ' value="yes"',
            '',
        ];
        yield 'populated model, matching array' => [
            'no',
            'yes',
            true,
            ['yes'],
            ' value="yes"',
            ' checked',
        ];
        yield 'populated model, omitted value' => [
            'yes',
            'yes',
            false,
            null,
            ' value="yes"',
            ' checked',
        ];
        yield 'populated model, zero' => [
            'yes',
            0,
            true,
            0,
            ' value="0"',
            ' checked',
        ];
    }

    /**
     * @return iterable<string, array{mixed, bool, mixed, string, string}>
     */
    public static function listValues(): iterable
    {
        yield 'empty model, explicit null' => [
            [],
            true,
            null,
            '',
            '',
        ];
        yield 'empty model, omitted value' => [
            [],
            false,
            null,
            '',
            '',
        ];
        yield 'populated model, empty array' => [
            ['yes', 0],
            true,
            [],
            '',
            '',
        ];
        yield 'populated model, empty string' => [
            ['yes', 0],
            true,
            '',
            '',
            '',
        ];
        yield 'populated model, explicit null' => [
            ['yes', 0],
            true,
            null,
            '',
            '',
        ];
        yield 'populated model, false' => [
            ['yes', 0],
            true,
            false,
            '',
            '',
        ];
        yield 'populated model, matching array' => [
            [0],
            true,
            ['yes'],
            ' checked',
            '',
        ];
        yield 'populated model, omitted value' => [
            ['yes', 0],
            false,
            null,
            ' checked',
            ' checked',
        ];
        yield 'populated model, zero' => [
            ['yes'],
            true,
            0,
            '',
            ' checked',
        ];
    }

    /**
     * @return iterable<string, array{mixed, bool, mixed, string, string, string}>
     */
    public static function selectValues(): iterable
    {
        yield 'empty model, explicit null' => [
            null,
            true,
            null,
            '',
            '',
            '',
        ];
        yield 'empty model, omitted value' => [
            null,
            false,
            null,
            '',
            '',
            '',
        ];
        yield 'populated model, empty array' => [
            'yes',
            true,
            [],
            '',
            '',
            '',
        ];
        yield 'populated model, empty string' => [
            'yes',
            true,
            '',
            '',
            '',
            ' selected',
        ];
        yield 'populated model, explicit null' => [
            'yes',
            true,
            null,
            '',
            '',
            '',
        ];
        yield 'populated model, false' => [
            'yes',
            true,
            false,
            '',
            '',
            '',
        ];
        yield 'populated model, omitted value' => [
            'yes',
            false,
            null,
            ' selected',
            '',
            '',
        ];
        yield 'populated model, single array' => [
            'yes',
            true,
            [0],
            '',
            ' selected',
            '',
        ];
        yield 'populated model, zero' => [
            'yes',
            true,
            0,
            '',
            ' selected',
            '',
        ];
    }

    /**
     * @return iterable<string, array{mixed, bool, mixed, string, string}>
     */
    public static function textAreaValues(): iterable
    {
        yield 'populated model, omitted value' => [
            'model-value',
            false,
            null,
            ' value="model-value"',
            'model-value',
        ];
        yield 'empty model, omitted value' => [
            '',
            false,
            null,
            '',
            '',
        ];
        yield 'null model, omitted value' => [
            null,
            false,
            null,
            '',
            '',
        ];
        yield 'populated model, explicit null' => [
            'model-value',
            true,
            null,
            '',
            '',
        ];
        yield 'empty model, explicit null' => [
            '',
            true,
            null,
            '',
            '',
        ];
        yield 'populated model, false' => [
            'model-value',
            true,
            false,
            '',
            '',
        ];
        yield 'populated model, empty string' => [
            'model-value',
            true,
            '',
            '',
            '',
        ];
        yield 'populated model, integer zero' => [
            'model-value',
            true,
            0,
            ' value="0"',
            '',
        ];
        yield 'populated model, string zero' => [
            'model-value',
            true,
            '0',
            ' value="0"',
            '0',
        ];
        yield 'populated model, encoded override' => [
            'model-value',
            true,
            '<b>&amp;"',
            ' value="&lt;b&gt;&amp;amp;&quot;"',
            '&lt;b&gt;&amp;amp;"',
        ];
    }

    /**
     * @return iterable<string, array{mixed, bool, mixed, string}>
     */
    public static function textValues(): iterable
    {
        yield 'empty model, explicit null' => [
            '',
            true,
            null,
            '',
        ];
        yield 'empty model, omitted value' => [
            '',
            false,
            null,
            '',
        ];
        yield 'null model, omitted value' => [
            null,
            false,
            null,
            '',
        ];
        yield 'populated model, empty string' => [
            'model-value',
            true,
            '',
            '',
        ];
        yield 'populated model, encoded override' => [
            'model-value',
            true,
            '<b>&amp;"',
            ' value="&lt;b&gt;&amp;amp;&quot;"',
        ];
        yield 'populated model, explicit null' => [
            'model-value',
            true,
            null,
            '',
        ];
        yield 'populated model, false' => [
            'model-value',
            true,
            false,
            '',
        ];
        yield 'populated model, integer zero' => [
            'model-value',
            true,
            0,
            ' value="0"',
        ];
        yield 'populated model, omitted value' => [
            'model-value',
            false,
            null,
            ' value="model-value"',
        ];
        yield 'populated model, string zero' => [
            'model-value',
            true,
            '0',
            ' value="0"',
        ];
    }
}
