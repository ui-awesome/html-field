<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UnitEnum;

/**
 * Provides an immutable API for configuring the container enclosing the form control.
 */
trait HasInputContainer
{
    /**
     * @var mixed[] HTML attributes for the input container tag.
     */
    private array $inputContainerAttributes = [];
    /**
     * Tag enclosing the form control, `false` to render the control without a container, or `null` when not
     * configured.
     */
    private false|UnitEnum|null $inputContainerTag = null;

    /**
     * Sets the input container tag attributes.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->inputContainerAttributes(['data-role' => 'control']);
     * ```
     *
     * @param mixed[] $values Attribute values indexed by attribute name.
     */
    public function inputContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->inputContainerAttributes, $values);

        return $new;
    }

    /**
     * Sets the input container tag `class` attribute.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->inputContainerClass('input-group');
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value CSS class to add, or `null` to keep the current class list.
     * @param bool $override Whether to replace the current class list instead of appending.
     */
    public function inputContainerClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->inputContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the input container tag.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->inputContainerTag(\UIAwesome\Html\Interop\Block::DIV);
     * ```
     *
     * @param false|UnitEnum $value Tag enclosing the form control, or `false` to render it without a container.
     */
    public function inputContainerTag(false|UnitEnum $value): static
    {
        $new = clone $this;
        $new->inputContainerTag = $value;

        return $new;
    }
}
