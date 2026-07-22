<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use InvalidArgumentException;

/**
 * Thrown when the configured form model property does not exist.
 */
final class AttributeNotSet extends InvalidArgumentException
{
    public function __construct(string $property)
    {
        parent::__construct("Form model property \"{$property}\" does not exist.");
    }
}
