<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UnitEnum;

/**
 * Provides methods for configuring field input container.
 */
trait HasInputContainer
{
    /**
     * @phpstan-var mixed[]
     */
    private array $inputContainerAttributes = [];
    private false|UnitEnum $inputContainerTag = false;

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param mixed[] $values Attribute values indexed by attribute names.
     */
    public function inputContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->inputContainerAttributes, $values);

        return $new;
    }

    /**
     * Returns a new instance with add css class to the input container.
     *
     * @param string $value The css class name.
     * @param bool $override Whether to override the existing class.
     */
    public function inputContainerClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->inputContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the input container tag.
     *
     * @param false|UnitEnum $value The tag for the input container.
     * If `false` the input container will be disabled.
     *
     * @return static A new instance of the current class with the specified input container tag.
     * If `false` the input container will be disabled.
     */
    public function inputContainerTag(false|UnitEnum $value): static
    {
        $new = clone $this;
        $new->inputContainerTag = $value;

        return $new;
    }
}
