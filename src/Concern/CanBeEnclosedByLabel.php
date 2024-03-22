<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

/**
 * Provides methods for configuring enclosing field by label.
 */
trait CanBeEnclosedByLabel
{
    protected bool $enclosedByLabel = false;

    /**
     * Set the current instance as being enclosed by a label.
     *
     * @return self A new instance of of the current class with the specified enclosed by label property.
     */
    public function enclosedByLabel(): self
    {
        $new = clone $this;
        $new->enclosedByLabel = true;

        return $new;
    }
}
