<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

/**
 * Text payloads for {@see \UIAwesome\Html\Field\Tests\Text\ErrorTest}.
 */
final class ErrorProvider
{
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
}
