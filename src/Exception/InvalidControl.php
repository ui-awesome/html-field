<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use UnexpectedValueException;

/**
 * Thrown when a registered factory definition does not create a form control.
 *
 * Usage example:
 * ```php
 * throw new \UIAwesome\Html\Field\Exception\InvalidControl('field.control.custom', 'stdClass');
 * ```
 */
final class InvalidControl extends UnexpectedValueException
{
    /**
     * @param string $component Semantic component name whose definition misbehaved.
     * @param string $type Type actually returned by the definition.
     */
    public function __construct(string $component, string $type)
    {
        parent::__construct(
            Message::INVALID_CONTROL_RETURNED->getMessage($component, $type),
        );
    }
}
