<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Factory;

use Closure;
use InvalidArgumentException;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Config\ComponentContext;
use UIAwesome\Html\Core\Factory\ComponentFactoryInterface;
use UIAwesome\Html\Field\Exception\{ControlNotFound, InvalidControl, Message};
use UIAwesome\Html\Form\{
    InputCheckbox,
    InputEmail,
    InputPassword,
    InputRadio,
    InputText,
    Select,
    TextArea,
};

use function get_debug_type;
use function is_a;
use function is_string;
use function preg_match;
use function str_contains;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Creates form controls from semantic `field.control.*` component contexts.
 *
 * Registered definitions are immutable. Pass replacements to the constructor or use {@see with()} to derive a new
 * factory without modifying the original instance.
 *
 * Usage example:
 * ```php
 * $controlFactory = new \UIAwesome\Html\Field\Factory\ControlFactory();
 * $control = $controlFactory->create(new \UIAwesome\Html\Core\Config\ComponentContext('field.control.email'));
 * ```
 */
final readonly class ControlFactory implements ComponentFactoryInterface
{
    /**
     * Semantic component prefix identifying field controls.
     */
    private const string COMPONENT_PREFIX = 'field.control.';
    /**
     * @var array<string, class-string<FormControlInterface>|Closure(ComponentContext): mixed> Control definitions
     * indexed by semantic type.
     */
    private array $definitions;

    /**
     * @param array<array-key, mixed> $definitions Control classes or context-aware closures replacing or extending the
     * defaults. Definitions are validated and normalized when the factory is constructed.
     *
     * @throws InvalidArgumentException If a definition type or value is invalid.
     */
    public function __construct(array $definitions = [])
    {
        $normalizedDefinitions = [];

        foreach ($definitions as $type => $definition) {
            $type = self::normalizeType($type);
            $normalizedDefinitions[$type] = self::normalizeDefinition($type, $definition);
        }

        $this->definitions = [...self::defaultDefinitions(), ...$normalizedDefinitions];
    }

    /**
     * Creates the form control represented by the supplied semantic context.
     *
     * Usage example:
     * ```php
     * $controlFactory = new \UIAwesome\Html\Field\Factory\ControlFactory();
     * $control = $controlFactory->create(new \UIAwesome\Html\Core\Config\ComponentContext('field.control.email'));
     * ```
     *
     * @param ComponentContext $context Semantic context identifying the `field.control.*` component to create.
     *
     * @throws ControlNotFound If the context does not identify a registered `field.control.*` component.
     * @throws InvalidControl If a registered closure does not return a form control.
     */
    public function create(ComponentContext $context): FormControlInterface
    {
        $type = self::resolveType($context);

        $definition = $this->definitions[$type] ?? throw new ControlNotFound($context->component);

        $control = is_string($definition) ? self::createFromClass($definition) : $definition($context);

        if (($control instanceof FormControlInterface) === false) {
            throw new InvalidControl($context->component, get_debug_type($control));
        }

        return $control;
    }

    /**
     * Returns a new factory with a replaced or additional control definition.
     *
     * Usage example:
     * ```php
     * $factory = new \UIAwesome\Html\Field\Factory\ControlFactory();
     * $factory = $factory->with('editor', \App\Html\EditorControl::class);
     * ```
     *
     * @param string $type Semantic type without the `field.control.` prefix.
     * @param class-string<FormControlInterface>|Closure(ComponentContext): mixed $definition Control class or
     * context-aware closure creating the control.
     *
     * @throws InvalidArgumentException If the type or the definition is invalid.
     */
    public function with(string $type, string|Closure $definition): self
    {
        $type = self::normalizeType($type);
        $definition = self::normalizeDefinition($type, $definition);

        return new self([...$this->definitions, $type => $definition]);
    }

    /**
     * Creates a registered control class while preserving class-level tag defaults when available.
     *
     * @param class-string<FormControlInterface> $definition Registered form control class.
     */
    private static function createFromClass(string $definition): FormControlInterface
    {
        return is_a($definition, BaseTag::class, true) ? $definition::tag() : new $definition();
    }

    /**
     * Returns the default control registry.
     *
     * @return array<string, class-string<FormControlInterface>> Control classes indexed by semantic type.
     */
    private static function defaultDefinitions(): array
    {
        return [
            'checkbox' => InputCheckbox::class,
            'email' => InputEmail::class,
            'password' => InputPassword::class,
            'radio' => InputRadio::class,
            'select' => Select::class,
            'text' => InputText::class,
            'textarea' => TextArea::class,
        ];
    }

    /**
     * Validates that a definition is a form control class or a closure.
     *
     * @throws InvalidArgumentException If the definition is neither a form control class nor a closure.
     *
     * @return class-string<FormControlInterface>|Closure(ComponentContext): mixed Validated definition.
     */
    private static function normalizeDefinition(string $type, mixed $definition): string|Closure
    {
        if (
            $definition instanceof Closure
            || (is_string($definition) && is_a($definition, FormControlInterface::class, true))
        ) {
            return $definition;
        }

        throw new InvalidArgumentException(
            Message::CONTROL_DEFINITION_INVALID->getMessage($type),
        );
    }

    /**
     * Validates that a type is a non-empty string without whitespace or dots.
     *
     * @throws InvalidArgumentException If the type is invalid.
     */
    private static function normalizeType(mixed $type): string
    {
        if (
            is_string($type) && $type !== ''
            && str_contains($type, '.') === false && preg_match('/\s/u', $type) === 0
        ) {
            return $type;
        }

        throw new InvalidArgumentException(
            Message::CONTROL_TYPE_INVALID->getMessage(),
        );
    }

    /**
     * Extracts the semantic type from the component context.
     *
     * @throws ControlNotFound If the component does not carry the `field.control.` prefix.
     */
    private static function resolveType(ComponentContext $context): string
    {
        if (str_starts_with($context->component, self::COMPONENT_PREFIX) === false) {
            throw new ControlNotFound($context->component);
        }

        return substr($context->component, strlen(self::COMPONENT_PREFIX));
    }
}
