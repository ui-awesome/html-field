<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

/**
 * Provides an immutable API for configuring validation state classes on the form control.
 */
trait HasValidateClass
{
    /**
     * CSS class added to the form control when the property has validation errors.
     */
    private string $invalidClass = '';
    /**
     * CSS class added to the form control when the property is validated without errors.
     */
    private string $validClass = '';

    /**
     * Sets the CSS class added to the form control when the property has validation errors.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->invalidClass('is-invalid');
     * ```
     *
     * @param string $value CSS class marking the control as invalid.
     */
    public function invalidClass(string $value): static
    {
        $new = clone $this;
        $new->invalidClass = $value;

        return $new;
    }

    /**
     * Sets the CSS class added to the form control when the property is validated without errors.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->validClass('is-valid');
     * ```
     *
     * @param string $value CSS class marking the control as valid.
     */
    public function validClass(string $value): static
    {
        $new = clone $this;
        $new->validClass = $value;

        return $new;
    }
}
