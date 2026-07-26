<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use InvalidArgumentException;

/**
 * Thrown when no form control is registered for a semantic component context.
 *
 * Usage example:
 * ```php
 * throw new \UIAwesome\Html\Field\Exception\ControlNotFound('field.control.unknown');
 * ```
 */
final class ControlNotFound extends InvalidArgumentException
{
    /**
     * @param string $component Semantic component name without a registered control.
     */
    public function __construct(string $component)
    {
        parent::__construct(
            Message::CONTROL_NOT_FOUND->getMessage($component),
        );
    }
}
