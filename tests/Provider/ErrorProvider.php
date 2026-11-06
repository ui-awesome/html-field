<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

use UIAwesome\Html\Interop\Inline;

/**
 * Data provider for {@see \UIAwesome\Html\Field\Tests\Text\ErrorTest} test cases.
 *
 * Provides error payloads, rendering tags, fallback precedence, and first/all-error modes.
 */
final class ErrorProvider
{
    /**
     * @return array<string, array{string, Inline|false|null, string}>
     */
    public static function allErrors(): array
    {
        $cases = [];

        foreach (self::modelErrors() as $name => [$payload, $tag, $all, $fallback]) {
            if ($all) {
                $cases[$name] = [$payload, $tag, $fallback];
            }
        }

        return $cases;
    }

    /**
     * @return array<string, array{string, Inline|false|null, string, string|null}>
     */
    public static function fallback(): array
    {
        $cases = [];

        foreach (self::text() as $name => [$payload]) {
            foreach (self::tags() as $tagName => [$tag, $expectedTag]) {
                $expected = $tag === null ? "\n$payload\n" : $payload;
                $cases["$name / $tagName"] = [$payload, $tag, $expected, $expectedTag];
            }
        }

        return $cases;
    }

    /**
     * @return array<string, array{string, Inline|false|null, bool, string, string, string|null}>
     */
    public static function modelErrors(): array
    {
        $modes = ['first error' => false, 'all errors' => true];
        $fallbacks = ['without fallback' => '', 'with fallback' => 'Fallback &amp; <b>inert</b>'];
        $cases = [];

        foreach (self::text() as $name => [$payload]) {
            foreach (self::tags() as $tagName => [$tag, $expectedTag]) {
                foreach ($modes as $modeName => $all) {
                    foreach ($fallbacks as $fallbackName => $fallback) {
                        // XML normalizes presentation line endings to LF, without normalizing the payload.
                        $text = $all ? $payload . "\nSecond &amp; <b>inert</b>\nLast \"quoted\" error" : $payload;
                        $expected = $tag === null ? "\n$text\n" : $text;
                        $cases["$name / $tagName / $modeName / $fallbackName"] = [
                            $payload, $tag, $all, $fallback, $expected, $expectedTag,
                        ];
                    }
                }
            }
        }

        return $cases;
    }
    /**
     * @return array<string, array{string}>
     */
    public static function text(): array
    {
        return [
            'ordinary' => ['Invalid username.'],
            'special characters' => ['< > & " \''],
            'literal entities' => ['&amp; &#60; &lt;'],
            'element and event' => ['<img src="inert" onerror="inert()">'],
            'closing tags' => ['</div></span><script>inert()</script><div>'],
            'foreign content' => ['<svg onload="inert()"><title>inert</title></svg>'],
            'whitespace' => ['  Invalid username.  '],
            'zero' => ['0'],
        ];
    }

    /**
     * @return array<string, array{Inline|false|null, string|null}>
     */
    private static function tags(): array
    {
        return [
            'default block' => [null, 'div'],
            'inline span' => [Inline::SPAN, 'span'],
            'without tag' => [false, null],
        ];
    }
}
