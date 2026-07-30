<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field;

use UIAwesome\Html\Core\Config\{ComponentContext, Config};
use UIAwesome\Html\Core\Exception\{ConfigException, Message};
use UIAwesome\Html\Field\Mixin\{CanBeEnclosedByLabel, HasInputContainer, HasInputTemplate};
use UIAwesome\Html\Mixin\HasLabelCollection;
use UnitEnum;

use function get_debug_type;

/**
 * Resolves and carries themed layout state for the label and input-container slots of the final semantic control.
 *
 * Theme recipes for the `field.label`, `field.input-container.<type>`, and `field.label.<type>` contexts are applied
 * to this carrier during rendering, never to the field. The merge methods layer the themed values under field-local
 * state, so fluent calls always override themed layout values regardless of call order.
 *
 * Usage example:
 * ```php
 * yield new \UIAwesome\Html\Core\Config\Recipe(
 *     'app.field.input-container.checkbox',
 *     new \UIAwesome\Html\Core\Config\Cookbook(
 *         new \UIAwesome\Html\Core\Config\Call('inputContainerClass', 'form-check'),
 *     ),
 * );
 * ```
 */
final class ControlLayout
{
    use CanBeEnclosedByLabel;
    use HasInputContainer;
    use HasInputTemplate;
    use HasLabelCollection;

    /**
     * Returns the effective enclosure flag, preferring field-local state over the themed value.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $enclosed = $layout->mergeEnclosedByLabel(false);
     * ```
     *
     * @param bool|null $local Field-local enclosure flag, or `null` when not configured.
     *
     * @return bool|null Effective enclosure flag, or `null` when neither side configures it.
     */
    public function mergeEnclosedByLabel(bool|null $local): bool|null
    {
        return $local ?? $this->enclosedByLabel;
    }

    /**
     * Returns the effective input container attributes, filling only keys the field does not set.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $attributes = $layout->mergeInputContainerAttributes(['class' => 'local-container']);
     * ```
     *
     * @param mixed[] $local Field-local input container attributes indexed by attribute name.
     *
     * @return mixed[] Effective attribute values indexed by attribute name.
     */
    public function mergeInputContainerAttributes(array $local): array
    {
        return $local + $this->inputContainerAttributes;
    }

    /**
     * Returns the effective input container tag, preferring field-local state over the themed value.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $tag = $layout->mergeInputContainerTag(false);
     * ```
     *
     * @param false|UnitEnum|null $local Field-local tag, `false` for no container, or `null` when not configured.
     *
     * @return false|UnitEnum|null Effective tag, or `null` when neither side configures it.
     */
    public function mergeInputContainerTag(false|UnitEnum|null $local): false|UnitEnum|null
    {
        return $local ?? $this->inputContainerTag;
    }

    /**
     * Returns the effective input template, preferring an explicitly configured field-local template.
     *
     * A themed template outranks the template derived from the control type, which is returned when neither the
     * field nor a theme recipe configured one.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $inputTemplate = $layout->mergeInputTemplate("{label}\n{input}", false);
     * ```
     *
     * @param string $local Field-local input template, explicitly configured or derived from the control type.
     * @param bool $localConfigured Whether the field-local template was explicitly configured.
     *
     * @return string Effective input template.
     */
    public function mergeInputTemplate(string $local, bool $localConfigured): string
    {
        return $localConfigured === false && $this->inputTemplateConfigured ? $this->inputTemplate : $local;
    }

    /**
     * Returns the effective label text, preferring field-local state over the themed value.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $label = $layout->mergeLabel('Local label');
     * ```
     *
     * @param string $local Field-local label text, or an empty string when not configured.
     *
     * @return string Effective label text.
     */
    public function mergeLabel(string $local): string
    {
        return $local === '' ? $this->label : $local;
    }

    /**
     * Returns the effective label attributes, filling only keys the field does not set.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $attributes = $layout->mergeLabelAttributes(['class' => 'local-label']);
     * ```
     *
     * @param mixed[] $local Field-local label attributes indexed by attribute name.
     *
     * @return mixed[] Effective attribute values indexed by attribute name.
     */
    public function mergeLabelAttributes(array $local): array
    {
        return $local + $this->labelAttributes;
    }

    /**
     * Returns the effective label suppression flag, disabled by either the field or a theme recipe.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * $notLabel = $layout->mergeNotLabel(false);
     * ```
     *
     * @param bool $local Field-local label suppression flag.
     *
     * @return bool Effective label suppression flag.
     */
    public function mergeNotLabel(bool $local): bool
    {
        return $local || $this->notLabel;
    }

    /**
     * Resolves the themed layout for the final semantic control by applying its layout slot recipes.
     *
     * Applies the `field.label` recipe and, for semantic controls, the `field.input-container.<type>` and
     * `field.label.<type>` recipes to a fresh carrier. Slot contexts inherit every qualifier of the base context.
     *
     * Usage example:
     * ```php
     * $layout = \UIAwesome\Html\Field\ControlLayout::resolve($config, $context, 'checkbox');
     * ```
     *
     * @param Config $config Application-scoped config service providing the theme recipes.
     * @param ComponentContext $context Base field context whose qualifiers are inherited by every layout slot.
     * @param string|null $controlType Final semantic control type, or `null` for an explicitly supplied input.
     *
     * @throws ConfigException If a layout recipe cannot be applied or returns an incompatible carrier.
     *
     * @return self Carrier configured by the layout slot recipes of the final control.
     */
    public static function resolve(Config $config, ComponentContext $context, string|null $controlType): self
    {
        $slots = $controlType === null
            ? ['label']
            : ['label', "input-container.{$controlType}", "label.{$controlType}"];

        $layout = new self();

        foreach ($slots as $slot) {
            $slotContext = self::slotContext($context, $slot);

            $configured = $config->apply($layout, $slotContext);

            if (($configured instanceof self) === false) {
                throw new ConfigException(
                    Message::CONFIG_RETURNED_INCOMPATIBLE_COMPONENT->getMessage(
                        $slotContext->component,
                        self::class,
                        get_debug_type($configured),
                    ),
                );
            }

            $layout = $configured;
        }

        return $layout;
    }

    /**
     * Derives a layout slot context while preserving every field qualifier and metadata value.
     *
     * @param ComponentContext $context Base field context whose qualifiers are copied to the slot.
     * @param string $slot Slot name appended to the base component identifier.
     *
     * @return ComponentContext Derived slot context.
     */
    private static function slotContext(ComponentContext $context, string $slot): ComponentContext
    {
        return new ComponentContext(
            "{$context->component}.{$slot}",
            $context->variant,
            $context->size,
            $context->scheme,
            $context->states,
            $context->metadata,
        );
    }
}
