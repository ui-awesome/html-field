<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

/**
 * Provides methods for configuring field input class.
 */
trait HasClass
{
    protected string $class = '';
    protected bool $classOverride = false;

    /**
     * Set the `CSS` `HTML` field class attribute.
     *
     * @param string $value The `CSS` attribute of the widget.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified class value.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function class(string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->class = $value;
        $new->classOverride = $override;

        return $new;
    }
}
