<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Exception;

use InvalidArgumentException;

/**
 * Thrown when the widget is created without attribute.
 */
final class AttributeNotSet extends InvalidArgumentException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message ?: $this->getName());
    }

    /**
     * @return string the user-friendly name of this exception
     */
    private function getName(): string
    {
        return 'Failed to create widget because "attribute" is not set or not exists.';
    }
}
