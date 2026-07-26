<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Provides assertion helpers comparing rendered HTML with normalized line endings.
 */
final class Assert
{
    public static function equalsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        TestCase::assertSame(
            LineEndingNormalizer::normalize($expected),
            LineEndingNormalizer::normalize($actual),
            $message,
        );
    }
}
