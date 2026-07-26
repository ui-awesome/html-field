<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\Html\Core\Config\{Call, ComponentContext, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Test theme providing field recipes through semantic slot contexts.
 */
final readonly class FieldTheme implements ThemeInterface
{
    /**
     * @param array{
     *     field: string,
     *     container: string,
     *     label: string,
     *     control: string,
     *     hint: string,
     *     error: string,
     *     prefix: string,
     *     suffix: string
     * } $classes CSS classes indexed by field slot.
     */
    public function __construct(
        private string $name,
        private array $classes,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getRecipes(ComponentContext $context): iterable
    {
        $calls = match ($context->component) {
            'field' => [
                new Call('inputContainerTag', Block::DIV),
                new Call('inputContainerClass', $this->classes['field']),
            ],
            'field.container' => [new Call('containerClass', $this->classes['container'])],
            'field.label' => [new Call('labelClass', $this->classes['label'])],
            'field.control.email' => [new Call('class', $this->classes['control'])],
            'field.hint' => [
                new Call('hintTag', Inline::SPAN),
                new Call('hintClass', $this->classes['hint']),
            ],
            'field.error' => [
                new Call('errorTag', Inline::SPAN),
                new Call('errorClass', $this->classes['error']),
            ],
            'field.prefix' => [
                new Call('prefixTag', Inline::SPAN),
                new Call('prefixClass', $this->classes['prefix']),
            ],
            'field.suffix' => [
                new Call('suffixTag', Inline::SPAN),
                new Call('suffixClass', $this->classes['suffix']),
            ],
            default => [],
        };

        if ($calls !== []) {
            yield new Recipe("{$this->name}.{$context->component}", new Cookbook(...$calls));
        }
    }
}
