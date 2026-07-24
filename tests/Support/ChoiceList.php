<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use Stringable;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Form\InputHidden;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UnitEnum;

use function array_values;
use function is_string;

/**
 * Stub list form control exercising list-aware field rendering.
 */
final class ChoiceList implements FormControlInterface
{
    /**
     * @var mixed[]
     */
    private array $attributes = [];

    /**
     * @var array<mixed>|bool|float|int|string|Stringable|UnitEnum|null
     */
    private array|bool|float|int|string|Stringable|UnitEnum|null $checked = null;
    private bool $enclosedByLabel = false;

    /**
     * @var list<ChoiceItem>
     */
    private array $items = [];

    private bool|float|int|string|Stringable|UnitEnum|null $uncheckedValue = null;

    private function __construct(private readonly bool $checkbox) {}

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

    public static function checkbox(): self
    {
        return new self(true);
    }

    /**
     * @param array<mixed>|bool|float|int|string|Stringable|UnitEnum|null $value
     */
    public function checked(array|bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->checked = $value;

        return $new;
    }

    public function class(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->attributes, $value, $override);

        return $new;
    }

    public function enclosedByLabel(): self
    {
        $new = clone $this;
        $new->enclosedByLabel = true;

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

    public function isList(): true
    {
        return true;
    }

    public function items(ChoiceItem ...$items): self
    {
        $new = clone $this;
        $new->items = array_values($items);

        return $new;
    }

    public static function radio(): self
    {
        return new self(false);
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
        $id = $attributes['id'] ?? null;
        $name = $attributes['name'] ?? null;

        unset($attributes['id'], $attributes['name'], $attributes['value']);

        $id = is_string($id) ? $id : null;
        $name = is_string($name) ? $name : null;
        $inputName = $name !== null && $this->checkbox ? "{$name}[]" : $name;
        $content = [];

        if ($this->uncheckedValue !== null && $inputName !== null) {
            $content[] = InputHidden::tag()->name($inputName)->value($this->uncheckedValue)->render();
        }

        foreach ($this->items as $index => $item) {
            $itemId = $id === null ? null : "$id-w$index";
            $content[] = $item->render(
                $attributes,
                $itemId,
                $inputName,
                $this->checked,
                $this->enclosedByLabel,
            );
        }

        return "<div>\n" . implode("\n", $content) . "\n</div>";
    }

    public function uncheckedValue(bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->uncheckedValue = $value;

        return $new;
    }
}
