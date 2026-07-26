<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use InvalidArgumentException;

/**
 * Thrown when the configured form model property does not exist.
 *
 * Usage example:
 * ```php
 * throw new \UIAwesome\Html\Field\Exception\AttributeNotSet('email');
 * ```
 */
final class AttributeNotSet extends InvalidArgumentException
{
    /**
     * @param string $property Name of the missing form model property.
     */
    public function __construct(string $property)
    {
        parent::__construct(
            Message::ATTRIBUTE_NOT_SET->getMessage($property),
        );
    }
}
