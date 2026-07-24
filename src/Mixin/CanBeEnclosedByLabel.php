<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

/**
 * Provides an immutable API for enclosing the form control inside its label.
 */
trait CanBeEnclosedByLabel
{
    /**
     * Whether the label encloses the form control.
     */
    protected bool $enclosedByLabel = false;

    /**
     * Sets whether the label encloses the form control.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->enclosedByLabel();
     * ```
     *
     * @param bool $value Whether to render the form control inside the label.
     */
    public function enclosedByLabel(bool $value = true): static
    {
        $new = clone $this;
        $new->enclosedByLabel = $value;

        return $new;
    }
}
