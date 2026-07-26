<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\Html\Attribute\Global\HasClass;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Helper\Attributes;
use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Stub form control rendering a generic `<control>` tag for field rendering tests.
 */
final class InputWidget extends BaseTag implements FormControlInterface
{
    use HasAttributes;
    use HasClass;

    public function enclosedByLabel(): static
    {
        return clone $this;
    }

    public function src(string $value): static
    {
        return $this->addAttribute('src', $value);
    }

    public function value(mixed $value): static
    {
        return $this->addAttribute('value', $value);
    }

    protected function run(): string
    {
        return '<control' . Attributes::render($this->getAttributes()) . '>';
    }
}
