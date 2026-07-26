<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Mixin;

use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Encode};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function implode;

/**
 * Provides an immutable API for configuring the field error section.
 */
trait HasError
{
    /**
     * @var mixed[] HTML attributes for the error tag.
     */
    private array $errorAttributes = [];
    /**
     * Fallback error text rendered when the form model has no error for the property.
     */
    private string $errorContent = '';
    /**
     * Tag enclosing the error content, or `false` to render the content without a tag.
     */
    private false|UnitEnum $errorTag = Block::DIV;
    /**
     * Whether to render every property error instead of only the first one.
     */
    private bool $showAllErrors = false;

    /**
     * Sets the error tag attributes.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->errorAttributes(['data-role' => 'error']);
     * ```
     *
     * @param mixed[] $values Attribute values indexed by attribute name.
     */
    public function errorAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->errorAttributes, $values);

        return $new;
    }

    /**
     * Sets the error tag `class` attribute.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->errorClass('is-invalid');
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value CSS class to add, or `null` to keep the current class list.
     * @param bool $override Whether to replace the current class list instead of appending.
     */
    public function errorClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->errorAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the fallback error text.
     *
     * Values are HTML-encoded.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->errorContent('Review this value.');
     * ```
     *
     * @param string|Stringable ...$values Error text parts concatenated in order.
     */
    public function errorContent(string|Stringable ...$values): static
    {
        $new = clone $this;
        $new->errorContent = Encode::content(implode('', $values));

        return $new;
    }

    /**
     * Sets the error tag.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->errorTag(\UIAwesome\Html\Interop\Inline::SPAN);
     * ```
     *
     * @param false|UnitEnum $value Tag enclosing the error content, or `false` to render the content without a tag.
     */
    public function errorTag(false|UnitEnum $value): static
    {
        $new = clone $this;
        $new->errorTag = $value;

        return $new;
    }

    /**
     * Enables rendering of every property error instead of only the first one.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->showAllErrors();
     * ```
     */
    public function showAllErrors(): static
    {
        $new = clone $this;
        $new->showAllErrors = true;

        return $new;
    }
}
