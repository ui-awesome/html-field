<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use Stringable;
use UIAwesome\Html\Form\{InputCheckbox, InputRadio};
use UIAwesome\Html\Helper\CSSClass;
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

/**
 * Stub choice option consumed by the list control stubs.
 */
final class ChoiceItem
{
    private string $label = '';
    /**
     * @var mixed[]
     */
    private array $labelAttributes = [];
    private bool|float|int|string|Stringable|UnitEnum|null $value = null;

    private function __construct(private readonly bool $checkbox) {}

    public static function checkbox(): self
    {
        return new self(true);
    }

    public function label(string $value): self
    {
        $new = clone $this;
        $new->label = $value;

        return $new;
    }

    public function labelClass(string $value, bool $override = false): self
    {
        $new = clone $this;
        CSSClass::add($new->labelAttributes, $value, $override);

        return $new;
    }

    public static function radio(): self
    {
        return new self(false);
    }

    /**
     * @param mixed[] $attributes
     * @param array<mixed>|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    public function render(
        array $attributes,
        string|null $id,
        string|null $name,
        array|bool|float|int|string|Stringable|UnitEnum|null $checked,
        bool $enclosedByLabel,
    ): string {
        $input = $this->checkbox ? InputCheckbox::tag() : InputRadio::tag();
        $input = $input
            ->attributes($attributes)
            ->checked($checked)
            ->id($id)
            ->name($name)
            ->value($this->value);

        $label = Label::tag()
            ->attributes($this->labelAttributes)
            ->for($id);

        return $enclosedByLabel
            ? $label->html($input->render())->content($this->label)->render()
            : $input->render() . "\n" . $label->content($this->label)->render();
    }

    public function value(bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }
}
