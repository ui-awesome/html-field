<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

/**
 * Provides an immutable API for configuring the input rendering template.
 */
trait HasInputTemplate
{
    /**
     * Template arranging the `{label}` and `{input}` parts of the field.
     */
    protected string $inputTemplate = '';

    /**
     * Sets the input rendering template.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->inputTemplate("{input}\n{label}");
     * ```
     *
     * @param string $value Template arranging the `{label}` and `{input}` parts of the field.
     */
    public function inputTemplate(string $value): static
    {
        $new = clone $this;
        $new->inputTemplate = $value;

        return $new;
    }
}
