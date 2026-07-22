<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Helper\{AttributeBag, Attributes, CSSClass, Encode, Enum};
use UnitEnum;

use function in_array;
use function is_array;
use function is_object;

final class SelectControl implements FormControlInterface
{
    /**
     * @phpstan-var mixed[]
     */
    private array $attributes = [];

    /**
     * @phpstan-var array<int|string, string>
     */
    private array $items = [];

    private mixed $value = null;

    public function __toString(): string
    {
        return $this->render();
    }

    public function addAttribute(string|UnitEnum $key, mixed $value): static
    {
        $new = clone $this;
        AttributeBag::set($new->attributes, $key, $value);

        return $new;
    }

    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = [...$new->attributes, ...$values];

        return $new;
    }

    public function class(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->attributes, $value, $override);

        return $new;
    }

    public function getAttribute(string|UnitEnum $key, mixed $default = null): mixed
    {
        return AttributeBag::get($this->attributes, $key, $default);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array<int|string, string> $items
     */
    public function items(array $items): self
    {
        $new = clone $this;
        $new->items = $items;

        return $new;
    }

    public function removeAttribute(string|UnitEnum $key): static
    {
        $new = clone $this;
        AttributeBag::remove($new->attributes, $key);

        return $new;
    }

    public function render(): string
    {
        $attributes = $this->attributes;
        unset($attributes['value']);

        $options = ['<option>Select an option</option>'];
        $selectedValues = Enum::normalizeStringArray(is_array($this->value) ? $this->value : [$this->value]);

        foreach ($this->items as $value => $label) {
            $optionAttributes = ['value' => $value];
            $optionAttributes['selected'] = in_array(Enum::normalizeStringValue($value), $selectedValues, true);
            $options[] = '<option' . Attributes::render($optionAttributes) . '>' . Encode::content($label) . '</option>';
        }

        return '<select' . Attributes::render($attributes) . ">\n" . implode("\n", $options) . "\n</select>";
    }

    public static function tag(): self
    {
        return new self();
    }

    public function value(mixed $value): self
    {
        if (is_object($value) && !$value instanceof Stringable && !$value instanceof UnitEnum) {
            throw new InvalidArgumentException('Select control values cannot be arbitrary objects.');
        }

        $new = clone $this;
        $new->value = $value;

        return $new;
    }
}
