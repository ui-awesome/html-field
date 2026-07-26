<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use InvalidArgumentException;

/**
 * Thrown when a form model field config cannot be converted into ordered config calls.
 *
 * Field config entries must be indexed by non-empty method names and carry either a bare value or a positional
 * argument list.
 *
 * Usage example:
 * ```php
 * throw \UIAwesome\Html\Field\Exception\InvalidFieldConfig::forMethodName('email');
 * ```
 */
final class InvalidFieldConfig extends InvalidArgumentException
{
    /**
     * Creates an exception for an entry that is not indexed by a method name.
     *
     * Usage example:
     * ```php
     * throw \UIAwesome\Html\Field\Exception\InvalidFieldConfig::forMethodName('email');
     * ```
     *
     * @param string $property Name of the form model property owning the field config.
     */
    public static function forMethodName(string $property): self
    {
        return new self(
            Message::FIELD_CONFIG_METHOD_NAME_INVALID->getMessage($property),
        );
    }

    /**
     * Creates an exception for an entry passing its arguments as an associative array.
     *
     * Usage example:
     * ```php
     * throw \UIAwesome\Html\Field\Exception\InvalidFieldConfig::forNamedArguments('class', 'email');
     * ```
     *
     * @param string $method Method name of the offending entry.
     * @param string $property Name of the form model property owning the field config.
     */
    public static function forNamedArguments(string $method, string $property): self
    {
        return new self(
            Message::FIELD_CONFIG_ARGUMENTS_NOT_POSITIONAL->getMessage($method, $property),
        );
    }
}
