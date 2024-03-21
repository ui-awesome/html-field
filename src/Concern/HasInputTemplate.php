<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

/**
 * Provides the ability to set the template for the input of the field.
 */
trait HasInputTemplate
{
    protected string $inputTemplate = '';

    /**
     * Return a new instance with input template.
     *
     * @param string $value The input template.
     */
    public function inputTemplate(string $value): static
    {
        $new = clone $this;
        $new->inputTemplate = $value;

        return $new;
    }
}
