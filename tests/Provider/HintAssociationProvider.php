<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

use UIAwesome\Html\Field\Tests\Support\UnsupportedTag;
use UIAwesome\Html\Interop\{Block, Inline};
use UnitEnum;

/**
 * Provides hint rendering and description-token cases for {@see \UIAwesome\Html\Field\Tests\HintAssociationTest}.
 */
final class HintAssociationProvider
{
    /**
     * @return iterable<string, array{string|null, string}>
     */
    public static function descriptions(): iterable
    {
        yield 'absent' => [
            null,
            'custom-help',
        ];
        yield 'duplicates' => [
            'external-hint external-hint second-hint',
            'external-hint second-hint custom-help',
        ];
        yield 'empty' => [
            '',
            'custom-help',
        ];
        yield 'escaped external ID' => [
            'external&hint',
            'external&amp;hint custom-help',
        ];
        yield 'external' => [
            'external-hint',
            'external-hint custom-help',
        ];
        yield 'hint already first' => [
            'custom-help external-hint custom-help',
            'custom-help external-hint',
        ];
        yield 'hint already last' => [
            'external-hint custom-help',
            'external-hint custom-help',
        ];
        yield 'HTML whitespace' => [
            " \texternal-hint\nsecond-hint\fexternal-hint\r ",
            'external-hint second-hint custom-help',
        ];
        yield 'multiple' => [
            'external-hint second-hint',
            'external-hint second-hint custom-help',
        ];
    }

    /**
     * @return iterable<string, array{string, string, false|UnitEnum, string, string, string|null}>
     */
    public static function rendering(): iterable
    {
        yield 'block' => [
            'Hint',
            'custom-help',
            Block::DIV,
            "{field}\n{hint}",
            "<div id=\"custom-help\">\nHint\n</div>",
            'custom-help',
        ];
        yield 'carriage return ID' => [
            'Hint',
            "\r",
            Inline::SPAN,
            "{field}\n{hint}",
            "<span id=\"\r\">Hint</span>",
            null,
        ];
        yield 'empty content' => [
            '',
            'custom-help',
            Block::DIV,
            "{field}\n{hint}",
            '',
            null,
        ];
        yield 'empty ID' => [
            'Hint',
            '',
            Block::DIV,
            "{field}\n{hint}",
            "<div>\nHint\n</div>",
            null,
        ];
        yield 'form feed ID' => [
            'Hint',
            "\f",
            Inline::SPAN,
            "{field}\n{hint}",
            "<span id=\"\f\">Hint</span>",
            null,
        ];
        yield 'inline' => [
            'Hint',
            'custom-help',
            Inline::SPAN,
            "{field}\n{hint}",
            '<span id="custom-help">Hint</span>',
            'custom-help',
        ];
        yield 'multiple ID tokens' => [
            'Hint',
            'two ids',
            Inline::SPAN,
            "{field}\n{hint}",
            '<span id="two ids">Hint</span>',
            null,
        ];
        yield 'newline ID' => [
            'Hint',
            "\n",
            Inline::SPAN,
            "{field}\n{hint}",
            "<span id=\"\n\">Hint</span>",
            null,
        ];
        yield 'no hint slot' => [
            'Hint',
            'custom-help',
            Block::DIV,
            '{field}',
            '',
            null,
        ];
        yield 'no tag' => [
            'Hint',
            'custom-help',
            false,
            "{field}\n{hint}",
            'Hint',
            null,
        ];
        yield 'space ID' => [
            'Hint',
            ' ',
            Block::DIV,
            "{field}\n{hint}",
            "<div id=\" \">\nHint\n</div>",
            null,
        ];
        yield 'tab ID' => [
            'Hint',
            "\t",
            Inline::SPAN,
            "{field}\n{hint}",
            "<span id=\"\t\">Hint</span>",
            null,
        ];
        yield 'unsupported pure enum' => [
            'Hint',
            'custom-help',
            UnsupportedTag::DIV,
            "{field}\n{hint}",
            'Hint',
            null,
        ];
        yield 'zero content' => [
            '0',
            'custom-help',
            Block::DIV,
            "{field}\n{hint}",
            "<div id=\"custom-help\">\n0\n</div>",
            'custom-help',
        ];
        yield 'zero ID' => [
            'Hint',
            '0',
            Inline::SPAN,
            "{field}\n{hint}",
            '<span id="0">Hint</span>',
            '0',
        ];
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function singleControls(): iterable
    {
        foreach (['text', 'checkbox', 'radio'] as $type) {
            yield $type => [
                $type,
                <<<HTML
                <div>
                <input id="basicform-hint" name="BasicForm[hint]" type="{$type}" aria-describedby="external-hint basicform-hint-help">
                <div id="basicform-hint-help">
                This is a hint.
                </div>
                </div>
                HTML,
            ];
        }

        yield 'textarea' => [
            'textarea',
            <<<HTML
            <div>
            <textarea id="basicform-hint" name="BasicForm[hint]" aria-describedby="external-hint basicform-hint-help">
            </textarea>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
        ];
    }
}
