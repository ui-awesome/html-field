<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use UIAwesome\Html\{Helper\CssClass, Helper\Sanitize, Interop\RenderInterface};

/**
 * Provides methods for a configuring field hint.
 */
trait HasHint
{
    private array $hintAttributes = [];
    private string $hintClass = '';
    private string $hintContent = '';
    private string $hintId = '';
    private false|string $hintTag = 'div';

    /**
     * Returns a new instance with the hint attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function hintAttributes(array $values): static
    {
        $new = clone $this;
        $new->hintAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the hint css class.
     *
     * @param string $value The hint class.
     * @param bool $override Whether to override the existing class.
     */
    public function hintClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->hintAttributes, $value, $override);

        return $new;
    }

    /**
     * Returns a new instance with the hint text.
     *
     * @param string|RenderInterface ...$values The hint text.
     */
    public function hintContent(string|RenderInterface ...$values): static
    {
        $new = clone $this;
        $new->hintContent = Sanitize::html(...$values);

        return $new;
    }

    /**
     * Set the hint id.
     *
     * @param string $value The hint id.
     *
     * @return static A new instance of the current class with the specified hint id.
     */
    public function hintId(string $value): static
    {
        $new = clone $this;
        $new->hintId = $value;

        return $new;
    }

    /**
     * Set the hint tag.
     *
     * @param false|string $value The tag name for the hint tag.
     * If `false` the hint tag will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified hint tag.
     * If `false` the hint tag will be disabled.
     */
    public function hintTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The hint tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->hintTag = $value;

        return $new;
    }
}
