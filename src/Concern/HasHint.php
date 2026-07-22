<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Encode};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

/**
 * Provides methods for a configuring field hint.
 */
trait HasHint
{
    /**
     * @phpstan-var mixed[]
     */
    private array $hintAttributes = [];
    private string $hintClass = '';
    private string $hintContent = '';
    private string $hintId = '';
    private false|UnitEnum $hintTag = Block::DIV;

    /**
     * Returns a new instance with the hint attributes.
     *
     * @param mixed[] $values Attribute values indexed by attribute names.
     */
    public function hintAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->hintAttributes, $values);

        return $new;
    }

    /**
     * Returns a new instance with the hint css class.
     *
     * @param string $value The hint class.
     * @param bool $override Whether to override the existing class.
     */
    public function hintClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->hintAttributes, $value, $override);

        return $new;
    }

    /**
     * Returns a new instance with the hint text.
     *
     * @param RenderableInterface|string ...$values The hint text.
     */
    public function hintContent(string|RenderableInterface ...$values): static
    {
        $new = clone $this;
        $new->hintContent = '';

        foreach ($values as $value) {
            $new->hintContent .= $value instanceof RenderableInterface ? $value->render() : Encode::content($value);
        }

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
     * @param false|UnitEnum $value The tag for the hint.
     * If `false` the hint tag will be disabled.
     *
     * @return static A new instance of the current class with the specified hint tag.
     * If `false` the hint tag will be disabled.
     */
    public function hintTag(false|UnitEnum $value): static
    {
        $new = clone $this;
        $new->hintTag = $value;

        return $new;
    }
}
