<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use function sprintf;

/**
 * Represents error message templates for library exceptions.
 *
 * Use {@see Message::getMessage()} to format the template with `sprintf()` arguments.
 */
enum Message: string
{
    /**
     * Error when the configured form model property does not exist.
     *
     * Format: 'Form model property "%s" does not exist.'
     */
    case ATTRIBUTE_NOT_SET = 'Form model property "%s" does not exist.';

    /**
     * Error when a control definition is neither a form control class nor a closure.
     *
     * Format: 'Control definition for type "%s" must be a form control class or Closure.'
     */
    case CONTROL_DEFINITION_INVALID = 'Control definition for type "%s" must be a form control class or Closure.';

    /**
     * Error when no form control is registered for a semantic component.
     *
     * Format: 'No form control is registered for semantic component "%s".'
     */
    case CONTROL_NOT_FOUND = 'No form control is registered for semantic component "%s".';

    /**
     * Error when a control type is empty or contains whitespace or dots.
     *
     * Format: 'Control type must be a non-empty string without whitespace or dots.'
     */
    case CONTROL_TYPE_INVALID = 'Control type must be a non-empty string without whitespace or dots.';

    /**
     * Error when a registered factory definition does not create a form control.
     *
     * Format: 'Factory for semantic component "%s" must return a form control; %s returned.'
     */
    case INVALID_CONTROL_RETURNED = 'Factory for semantic component "%s" must return a form control; %s returned.';

    /**
     * Returns the formatted message string for the error case.
     *
     * Usage example:
     * ```php
     * throw new \InvalidArgumentException(
     *     \UIAwesome\Html\Field\Exception\Message::CONTROL_NOT_FOUND->getMessage('field.control.unknown'),
     * );
     * ```
     *
     * @param int|string ...$argument Values to insert into the message template.
     *
     * @return string Formatted error message with interpolated arguments.
     */
    public function getMessage(int|string ...$argument): string
    {
        return sprintf($this->value, ...$argument);
    }
}
