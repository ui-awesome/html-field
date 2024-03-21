<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use UIAwesome\Html\{Helper\CssClass, Helper\Sanitize, Interop\RenderInterface};

/**
 * Provides methods for configuring field error.
 */
trait HasError
{
    private array $errorAttributes = [];
    private string $errorClass = '';
    private string $errorContent = '';
    private false|string $errorTag = 'div';
    private bool $showAllErrors = false;

    /**
     * Returns a new instance with the error attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function errorAttributes(array $values): static
    {
        $new = clone $this;
        $new->errorAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the error class.
     *
     * @param string $value The error class.
     * @param bool $override Whether to override the current class.
     */
    public function errorClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->errorAttributes, $value, $override);

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * @param string|RenderInterface ...$values The error text.
     */
    public function errorContent(string|RenderInterface ...$values): static
    {
        $new = clone $this;
        $new->errorContent = Sanitize::html(...$values);

        return $new;
    }

    /**
     * Set the error tag.
     *
     * @param false|string $value The tag name for the error tag.
     * If `false` the error tag will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified error tag.
     * If `false` the error tag will be disabled.
     */
    public function errorTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The error tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->errorTag = $value;

        return $new;
    }

    /**
     * Returns a new instance with the show all errors flag.
     */
    public function showAllErrors(): static
    {
        $new = clone $this;
        $new->showAllErrors = true;

        return $new;
    }
}
