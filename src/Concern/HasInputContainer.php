<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use UIAwesome\Html\Helper\CssClass;

/**
 * Provides methods for configuring field input container.
 */
trait HasInputContainer
{
    private array $inputContainerAttributes = [];
    private false|string $inputContainerTag = false;

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function inputContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->inputContainerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with add css class to the input container.
     *
     * @param string $value The css class name.
     * @param bool $override Whether to override the existing class.
     */
    public function inputContainerClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->inputContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the input container tag.
     *
     * @param false|string $value The tag name for the input container.
     * If `false` the input container will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified input container tag.
     * If `false` the input container will be disabled.
     */
    public function inputContainerTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The input container tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->inputContainerTag = $value;

        return $new;
    }
}
