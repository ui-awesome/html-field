<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Concern;

use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Encode};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function implode;

/**
 * Provides methods for configuring field error.
 */
trait HasError
{
    /**
     * @phpstan-var mixed[]
     */
    private array $errorAttributes = [];
    private string $errorContent = '';
    private false|UnitEnum $errorTag = Block::DIV;
    private bool $showAllErrors = false;

    /**
     * Returns a new instance with the error attributes.
     *
     * @param mixed[] $values Attribute values indexed by attribute names.
     */
    public function errorAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->errorAttributes, $values);

        return $new;
    }

    /**
     * Returns a new instance with the error class.
     *
     * @param string $value The error class.
     * @param bool $override Whether to override the current class.
     */
    public function errorClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->errorAttributes, $value, $override);

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * Note: Values are HTML-encoded.
     *
     * @param Stringable|string ...$values The error text.
     */
    public function errorContent(string|Stringable ...$values): static
    {
        $new = clone $this;
        $new->errorContent = Encode::content(implode('', $values));

        return $new;
    }

    /**
     * Set the error tag.
     *
     * @param false|UnitEnum $value The tag for the error.
     * If `false` the error tag will be disabled.
     *
     * @return static A new instance of the current class with the specified error tag.
     * If `false` the error tag will be disabled.
     */
    public function errorTag(false|UnitEnum $value): static
    {
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
