<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Encode};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

/**
 * Provides an immutable API for configuring the field hint section.
 */
trait HasHint
{
    /**
     * @var mixed[] HTML attributes for the hint tag.
     */
    private array $hintAttributes = [];
    /**
     * Hint text rendered after the form control.
     */
    private string $hintContent = '';
    /**
     * Value for the hint tag `id` attribute, linked to the control through `aria-describedby`.
     */
    private string $hintId = '';
    /**
     * Tag enclosing the hint content, or `false` to render the content without a tag.
     */
    private false|UnitEnum $hintTag = Block::DIV;

    /**
     * Sets the hint tag attributes.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->hintAttributes(['data-role' => 'hint']);
     * ```
     *
     * @param mixed[] $values Attribute values indexed by attribute name.
     */
    public function hintAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->hintAttributes, $values);

        return $new;
    }

    /**
     * Sets the hint tag `class` attribute.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->hintClass('form-text');
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value CSS class to add, or `null` to keep the current class list.
     * @param bool $override Whether to replace the current class list instead of appending.
     */
    public function hintClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->hintAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the hint text.
     *
     * String values are HTML-encoded; renderable values are rendered as-is.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->hintContent('Choose a unique username.');
     * ```
     *
     * @param string|RenderableInterface ...$values Hint text parts concatenated in order.
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
     * Sets the hint tag `id` attribute.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->hintId('username-help');
     * ```
     *
     * @param string $value Identifier linking the hint to the control through `aria-describedby`.
     */
    public function hintId(string $value): static
    {
        $new = clone $this;
        $new->hintId = $value;

        return $new;
    }

    /**
     * Sets the hint tag.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->hintTag(\UIAwesome\Html\Interop\Inline::SPAN);
     * ```
     *
     * @param false|UnitEnum $value Tag enclosing the hint content, or `false` to render the content without a tag.
     */
    public function hintTag(false|UnitEnum $value): static
    {
        $new = clone $this;
        $new->hintTag = $value;

        return $new;
    }
}
