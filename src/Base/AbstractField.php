<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Base;

use BackedEnum;
use Override;
use UIAwesome\FormModel\FormModelInterface;
use UIAwesome\Html\Attribute\Global\{HasClass, HasId};
use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Contracts\Attribute\{AttributesInterface, SrcInterface, ValueInterface};
use UIAwesome\Html\Contracts\Element\ContentInterface;
use UIAwesome\Html\Contracts\Form\{
    CheckedStateInterface,
    ChoiceListInterface,
    FormControlInterface,
    MultiValueInterface,
    PlaceholderInterface,
};
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, ConfigApplier, Cookbook, Recipe};
use UIAwesome\Html\Core\Exception\{ConfigException, Message as ConfigMessage};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Field\ControlLayout;
use UIAwesome\Html\Field\Exception\{AttributeNotSet, InvalidControl, InvalidFieldConfig};
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Mixin\{
    CanBeEnclosedByLabel,
    HasError,
    HasHint,
    HasInputContainer,
    HasInputTemplate,
    HasValidateClass,
};
use UIAwesome\Html\Helper\{Encode, Naming, Template};
use UIAwesome\Html\Interop\{Block, Inline};
use UIAwesome\Html\Mixin\{
    HasAttributes,
    HasContainerCollection,
    HasLabelCollection,
    HasPrefixCollection,
    HasSuffixCollection,
    HasTemplate,
};
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

use function array_is_list;
use function get_debug_type;
use function implode;
use function is_array;
use function is_string;
use function preg_replace;

/**
 * Provides the immutable base implementation for rendering a form model property as a complete field.
 *
 * Composes the form control with its label, hint, error, prefix, suffix, and containers, resolving `id`, `name`,
 * `label`, `hint`, and `value` from the form model.
 */
abstract class AbstractField extends BaseTag
{
    use CanBeEnclosedByLabel;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasError;
    use HasHint;
    use HasId;
    use HasInputContainer;
    use HasInputTemplate;
    use HasLabelCollection;
    use HasName;
    use HasPrefixCollection;
    use HasSuffixCollection;
    use HasTemplate;
    use HasValidateClass;

    /**
     * Application-scoped config used to create and configure semantic controls.
     */
    private Config|null $config = null;
    /**
     * Base semantic context inherited by every field slot.
     */
    private ComponentContext|null $configContext = null;
    /**
     * Semantic control type created through the configured factory, or `null` for an explicitly supplied input.
     */
    private string|null $controlType = 'text';
    /**
     * Form model providing labels, hints, values, and per-property configuration.
     */
    private FormModelInterface|null $formModel = null;
    /**
     * Name of the form model property represented by the field.
     */
    private string $property = '';
    /**
     * Explicit field value used for model binding without becoming a control attribute.
     */
    private mixed $value = null;
    /**
     * Form control rendered by the field, or `null` until a control is configured.
     */
    private (AttributesInterface&RenderableInterface)|null $widget = null;

    /**
     * Applies application-scoped recipes to the field and each semantic slot.
     *
     * Slot contexts inherit the field qualifiers and use `field.container`, `field.control.*`, `field.hint`,
     * `field.error`, `field.prefix`, and `field.suffix` component identifiers by default. The `field.label`,
     * `field.input-container.*`, and `field.label.*` layout slots resolve during rendering against a
     * {@see ControlLayout} carrier for the final semantic control, so field-local fluent state overrides them.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->config($config);
     * ```
     *
     * @param Config $config Application-scoped config service.
     * @param ComponentContext $context Base field context whose qualifiers are inherited by every slot.
     *
     * @throws ConfigException If a recipe cannot be applied or returns an incompatible field.
     * @throws InvalidControl If the configured factory returns an incompatible control.
     */
    #[Override]
    public function config(Config $config, ComponentContext $context = new ComponentContext('field')): static
    {
        $field = $this->applyConfig($config, $context);

        $field = $field->applyConfig($config, self::slotContext($context, 'container'));

        if ($field === $this) {
            $field = clone $this;
        }

        $field->config = $config;
        $field->configContext = $context;

        $field = $field->configureControlFromConfig($config, $context);

        foreach (['hint', 'error', 'prefix', 'suffix'] as $slot) {
            $field = $field->applyConfig($config, self::slotContext($context, $slot));
        }

        $field->config = $config;
        $field->configContext = $context;

        return $field;
    }

    /**
     * Selects a semantic control type and creates it through the field control factory.
     *
     * The default registry supports `checkbox`, `checkbox-list`, `email`, `password`, `radio`, `radio-list`, `select`,
     * `text`, and `textarea`.
     *
     * When application config is present, its factory replaces the default registry and its recipe is applied to the
     * `field.control.<type>` context.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->control('email');
     * ```
     *
     * @param string $type Semantic control type without the `field.control.` prefix.
     *
     * @throws InvalidControl If the configured factory or applier returns an incompatible control.
     */
    public function control(string $type): static
    {
        $baseContext = $this->configContext ?? new ComponentContext('field');

        $context = self::slotContext($baseContext, "control.{$type}");

        $factory = $this->config->factory ?? new ControlFactory();

        $control = $factory->create($context);

        if (($control instanceof FormControlInterface) === false) {
            throw new InvalidControl($context->component, get_debug_type($control));
        }

        if ($this->config !== null) {
            $control = $this->config->apply($control, $context);

            if (($control instanceof FormControlInterface) === false) {
                throw new InvalidControl($context->component, get_debug_type($control));
            }
        }

        $new = $this->withWidget($control);
        $new->controlType = $type;

        return $new;
    }

    /**
     * Sets the form model used to configure and populate the field.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->formModel($formModel);
     * ```
     *
     * @param FormModelInterface $value Form model providing labels, hints, values, and per-property configuration.
     *
     * @throws AttributeNotSet If the configured property does not exist in the form model.
     */
    public function formModel(FormModelInterface $value): static
    {
        $new = clone $this;
        $new->formModel = $value;

        return $new->configureFromFormModel();
    }

    /**
     * Returns the configured form model.
     *
     * Usage example:
     * ```php
     * $formModel = \UIAwesome\Html\Field\Field::tag()->formModel($formModel)->getFormModel();
     * ```
     *
     * @return FormModelInterface|null Configured form model, or `null` when none is set.
     */
    public function getFormModel(): FormModelInterface|null
    {
        return $this->formModel;
    }

    /**
     * Returns the configured form model property.
     *
     * Usage example:
     * ```php
     * $property = \UIAwesome\Html\Field\Field::tag()->property('username')->getProperty();
     * ```
     *
     * @return string Name of the configured property, or an empty string when none is set.
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * Sets the form control rendered by the field.
     *
     * The form model field config is applied to the replacement, and checkbox or radio controls switch the input
     * template to render the control before its label.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->input(\UIAwesome\Html\Form\InputEmail::tag());
     * ```
     *
     * @param AttributesInterface&RenderableInterface $widget Form control replacing the configured default.
     */
    public function input(AttributesInterface&RenderableInterface $widget): static
    {
        $new = $this->withWidget($widget);
        $new->controlType = null;

        return $new;
    }

    /**
     * Sets the form model property represented by the field.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->property('username');
     * ```
     *
     * @param string $value Name of the form model property to render.
     *
     * @throws AttributeNotSet If the property does not exist in the configured form model.
     */
    public function property(string $value): static
    {
        $new = clone $this;
        $new->property = $value;

        return $new->configureFromFormModel();
    }

    /**
     * Sets the field value applied to the form control.
     *
     * An explicit value takes precedence over the value resolved from the form model. The selected value remains
     * separate from HTML attributes so checkbox and radio option values are preserved.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->value('admin');
     * ```
     *
     * @param mixed $value Selected value applied to the form control.
     */
    public function value(mixed $value): static
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }

    /**
     * Returns the default configuration applied when the field is created.
     *
     * @return array<string, mixed> Default container tag, control, and field template indexed by configuration method.
     */
    #[Override]
    protected function loadDefault(): array
    {
        return [
            'containerTag' => [Block::DIV],
            'control' => ['text'],
            'template' => ["{prefix}\n{field}\n{suffix}\n{hint}\n{error}"],
        ];
    }

    /**
     * Renders the field, or an empty string until the form model, property, and control are configured.
     *
     * @throws ConfigException If the form model field config cannot be applied to the resolved control.
     * @throws InvalidFieldConfig If the form model field config shape is not supported.
     *
     * @return string Rendered field markup, or an empty string for an incomplete configuration.
     */
    protected function run(): string
    {
        $field = $this->resolveControlLayout();

        $formModel = $field->formModel;
        $property = $field->property;
        $widget = $field->widget;

        if ($formModel === null || $property === '' || $widget === null) {
            return '';
        }

        $widget = $field->configureWidget($widget, $formModel, $property);
        $widget = $field->applyFieldConfig($widget, $formModel, $property);

        return $field->renderOptionalTag(
            $field->containerAttributes,
            $field->renderField($widget, $formModel, $property),
            $field->containerTag,
        );
    }

    /**
     * Applies recipes to the field while preserving the fluent component type.
     *
     * @param Config $config Application-scoped config service providing the theme recipes.
     * @param ComponentContext $context Semantic slot context resolved against the theme.
     *
     * @throws ConfigException If the config returns a component incompatible with the field.
     *
     * @return static Field configured by the matching theme recipes.
     */
    private function applyConfig(Config $config, ComponentContext $context): static
    {
        $field = $config->apply($this, $context);

        if (($field instanceof $this) === false) {
            throw new ConfigException(
                ConfigMessage::CONFIG_RETURNED_INCOMPATIBLE_COMPONENT->getMessage(
                    $context->component,
                    get_debug_type($this),
                    get_debug_type($field),
                ),
            );
        }

        return $field;
    }

    /**
     * Applies the form model field config to the resolved control through the core config applier in strict mode.
     *
     * The field config is applied once per render, against the control the field ultimately renders, so the fluent
     * call order does not change the outcome. A call naming a method the control does not expose fails instead of
     * being skipped.
     *
     * The form model binding runs first and derives the control state, so field config entries act as explicit
     * per-property overrides and are never silently discarded.
     *
     * @param AttributesInterface&RenderableInterface $widget Resolved form control receiving the field config.
     * @param FormModelInterface $formModel Form model providing the per-property field config.
     * @param string $property Name of the form model property owning the field config.
     *
     * @throws ConfigException If a call is unavailable, returns an incompatible control, fails during execution, or
     * the applier returns a component incompatible with the control.
     * @throws InvalidFieldConfig If the field config shape cannot be converted into ordered config calls.
     *
     * @return AttributesInterface&RenderableInterface Control configured by the field config entries.
     */
    private function applyFieldConfig(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        $context = self::slotContext($this->configContext ?? new ComponentContext('field'), 'control');

        $configured = (new ConfigApplier())->apply(
            $widget,
            new Recipe(
                "field-config.{$property}",
                self::toCookbook($formModel->getFieldConfig($property), $property),
            ),
            $context,
            strict: true,
        );

        if (($configured instanceof $widget) === false) {
            throw new ConfigException(
                ConfigMessage::CONFIG_RETURNED_INCOMPATIBLE_COMPONENT->getMessage(
                    $context->component,
                    get_debug_type($widget),
                    get_debug_type($configured),
                ),
            );
        }

        return $configured;
    }

    /**
     * Transfers the field attributes to the control and links the hint through `aria-describedby`.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control receiving the field attributes.
     *
     * @return AttributesInterface&RenderableInterface Control carrying the transferred attributes.
     */
    private function applyToAttributes(
        AttributesInterface&RenderableInterface $widget,
    ): AttributesInterface&RenderableInterface {
        $attributes = $this->getAttributes();

        if ($this->hintContent !== '' && $this->hintId !== '') {
            $widget = $widget->addAttribute('aria-describedby', $this->hintId);
        }

        if (
            $this->value !== null
            && ($widget instanceof CheckedStateInterface) === false
            && ($widget instanceof SrcInterface) === false
            && ($widget instanceof MultiValueInterface) === false
        ) {
            $attributes['value'] = $this->value;
        }

        return $widget->attributes($attributes);
    }

    /**
     * Applies the form model placeholder to controls supporting it.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control receiving the placeholder.
     * @param FormModelInterface $formModel Form model providing the placeholder text.
     * @param string $property Name of the form model property represented by the field.
     *
     * @return AttributesInterface&RenderableInterface Control with the placeholder applied when supported.
     */
    private function applyToPlaceholder(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        return $widget instanceof PlaceholderInterface
            ? $widget->placeholder($formModel->getPlaceholder($property))
            : $widget;
    }

    /**
     * Applies the resolved value through the first control contract supporting it.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control receiving the resolved value.
     * @param FormModelInterface $formModel Form model providing the property value.
     * @param string $property Name of the form model property represented by the field.
     *
     * @return AttributesInterface&RenderableInterface Control with the value applied through its first contract.
     */
    private function applyToValue(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        $value = $this->value ?? $formModel->getValue($property);

        if ($widget instanceof MultiValueInterface) {
            /** @phpstan-ignore argument.type */
            return $widget->value($value);
        }

        if ($widget instanceof CheckedStateInterface) {
            if ($widget->getAttribute('value') !== null || $widget instanceof ChoiceListInterface) {
                /** @phpstan-ignore argument.type */
                return $widget->checked($value);
            }
        }

        if ($widget instanceof ContentInterface && is_string($value)) {
            return $widget->content($value);
        }

        if ($widget instanceof SrcInterface && is_string($value)) {
            return $widget->src($value);
        }

        if ($widget instanceof ValueInterface) {
            /** @phpstan-ignore argument.type */
            return $widget->value($value);
        }

        return $widget;
    }

    /**
     * Creates a semantic control or applies the generic control-slot recipe to an explicitly supplied input.
     *
     * @param Config $config Application-scoped config service providing the theme recipes.
     * @param ComponentContext $configContext Base field context whose qualifiers are inherited by the control slot.
     *
     * @throws InvalidControl If the factory, recipe, or applier returns an incompatible control.
     *
     * @return static Field carrying the configured control.
     */
    private function configureControlFromConfig(Config $config, ComponentContext $configContext): static
    {
        if ($this->controlType !== null) {
            return $this->control($this->controlType);
        }

        if ($this->widget === null) {
            return $this;
        }

        $context = self::slotContext($configContext, 'control');

        $widget = $config->apply($this->widget, $context);

        if (($widget instanceof AttributesInterface) === false || ($widget instanceof RenderableInterface) === false) {
            throw new InvalidControl($context->component, get_debug_type($widget));
        }

        $new = $this->withWidget($widget);
        $new->controlType = null;

        return $new;
    }

    /**
     * Configures the field from the form model once both the model and the property are set.
     *
     * @throws AttributeNotSet If the property does not exist in the form model.
     * @throws ConfigException If the derived binding returns a component incompatible with the field.
     *
     * @return static Field configured with the model-derived `id`, `name`, `label`, and hint state.
     */
    private function configureFromFormModel(): static
    {
        $formModel = $this->formModel;
        $property = $this->property;

        if ($formModel === null || $property === '') {
            return $this;
        }

        if ($formModel->has($property) === false) {
            throw new AttributeNotSet($property);
        }

        $id = Naming::generateInputId($formModel->getModelName(), $property);

        $configured = SimpleFactory::configure(
            $this,
            [
                'hintContent' => [$formModel->getHint($property)],
                'hintId' => ["$id-help"],
                'id' => [$id],
                'label' => [$formModel->getLabel($property)],
                'name' => [Naming::generateInputName($formModel->getModelName(), $property)],
            ],
        );

        if (($configured instanceof $this) === false) {
            throw new ConfigException(
                ConfigMessage::CONFIG_RETURNED_INCOMPATIBLE_COMPONENT->getMessage(
                    'field',
                    get_debug_type($this),
                    get_debug_type($configured),
                ),
            );
        }

        return $configured;
    }

    /**
     * Applies attributes, placeholder, value, and validation state classes to the control.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control being prepared for rendering.
     * @param FormModelInterface $formModel Form model providing values and validation state.
     * @param string $property Name of the form model property represented by the field.
     *
     * @return AttributesInterface&RenderableInterface Control carrying attributes, value, and validation classes.
     */
    private function configureWidget(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        $widget = $this->applyToAttributes($widget);
        $widget = $this->applyToPlaceholder($widget, $formModel, $property);
        $widget = $this->applyToValue($widget, $formModel, $property);

        if ($formModel->hasError($property)) {
            $widget = $widget->class($this->invalidClass);
        }

        if ($formModel->isValidated($property)) {
            $widget = $widget->class($this->validClass);
        }

        return $widget;
    }

    /**
     * Returns the first property error, or every error joined by line breaks.
     *
     * @param FormModelInterface $formModel Form model providing the validation errors.
     * @param string $property Name of the form model property represented by the field.
     * @param bool $showAllErrors Whether to join every error instead of returning the first one.
     *
     * @return string Property errors, or an empty string without validation errors.
     */
    private function getPropertyError(
        FormModelInterface $formModel,
        string $property,
        bool $showAllErrors,
    ): string {
        return $showAllErrors
            ? implode(PHP_EOL, $formModel->getError($property))
            : $formModel->getFirstError($property);
    }

    /**
     * Determines whether the control renders a list of options.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control to inspect.
     *
     * @return bool Whether the control renders a list of options.
     */
    private function isListWidget(AttributesInterface&RenderableInterface $widget): bool
    {
        return $widget instanceof ChoiceListInterface;
    }

    /**
     * Renders the error section, falling back to the configured error content.
     *
     * @param FormModelInterface $formModel Form model providing the validation errors.
     * @param string $property Name of the form model property represented by the field.
     *
     * @return string Rendered error section, or an empty string without content.
     */
    private function renderErrorTag(FormModelInterface $formModel, string $property): string
    {
        $error = $this->getPropertyError($formModel, $property, $this->showAllErrors);

        return $this->renderOptionalTag(
            $this->errorAttributes,
            $error === '' ? $this->errorContent : $error,
            $this->errorTag,
        );
    }

    /**
     * Renders the field template and strips blank lines left by empty sections.
     *
     * @param AttributesInterface&RenderableInterface $widget Resolved form control rendered in the `{field}` section.
     * @param FormModelInterface $formModel Form model providing hint and error state.
     * @param string $property Name of the form model property represented by the field.
     *
     * @return string Rendered field template without blank lines left by empty sections.
     */
    private function renderField(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): string {
        $rendered = Template::render(
            $this->template,
            [
                '{error}' => $this->renderErrorTag($formModel, $property),
                '{field}' => $this->renderInputField($widget),
                '{hint}' => $this->renderHintTag(),
                '{prefix}' => $this->renderPrefixTag(),
                '{suffix}' => $this->renderSuffixTag(),
            ],
        );

        return preg_replace('/^\h*\v+/m', '', $rendered) ?? '';
    }

    /**
     * Renders the hint section.
     *
     * @return string Rendered hint section, or an empty string without content.
     */
    private function renderHintTag(): string
    {
        return $this->renderOptionalTag($this->hintAttributes, $this->hintContent, $this->hintTag, $this->hintId);
    }

    /**
     * Renders the label and control through the input template, enclosed by the input container.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control rendered in the `{input}` section.
     *
     * @return string Rendered label and control enclosed by the input container.
     */
    private function renderInputField(AttributesInterface&RenderableInterface $widget): string
    {
        [$widget, $label] = $this->renderLabelTag($widget);

        $rendered = Template::render(
            $this->inputTemplate,
            [
                '{input}' => $this->enclosedByLabel === true && $this->isListWidget($widget) === false
                    ? ''
                    : $widget->render(),
                '{label}' => $label,
            ],
        );

        return $this->renderOptionalTag(
            $this->inputContainerAttributes,
            $rendered,
            $this->inputContainerTag ?? false,
        );
    }

    /**
     * Renders the label, enclosing the control when configured.
     *
     * The `for` attribute follows the control's final `id`, so a field config overriding it stays linked.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control the label is linked to.
     *
     * @return array{AttributesInterface&RenderableInterface, string} Control to render and the rendered label markup.
     */
    private function renderLabelTag(AttributesInterface&RenderableInterface $widget): array
    {
        if ($this->isLabel() === false) {
            return [$widget, ''];
        }

        $id = $widget->getAttribute('id');
        $for = $this->getLabelAttribute('for', is_string($id) ? $id : null);

        $for = is_string($for) ? $for : null;

        $isList = $this->isListWidget($widget);

        if ($isList) {
            $for = null;
        }

        $label = Label::tag()
            ->attributes($this->getLabelAttributes())
            ->for($for);

        if ($this->enclosedByLabel === true) {
            if ($widget instanceof ChoiceListInterface) {
                return [$widget->enclosedByLabel(), $label->content($this->getLabel())->render()];
            }

            $content = $widget instanceof CheckedStateInterface
                ? "\n{$widget->render()}\n" . Encode::content($this->getLabel()) . "\n"
                : $widget->render();

            return [$widget, $label->html($content)->render()];
        }

        return [$widget, $label->content($this->getLabel())->render()];
    }

    /**
     * Encloses content in a tag, returning the content untouched for empty content or a disabled tag.
     *
     * @param array<array-key, mixed> $attributes Attribute values indexed by attribute name.
     * @param string $content Content enclosed by the tag.
     * @param false|UnitEnum $tag Tag enclosing the content, or `false` to return the content untouched.
     * @param string|null $id Identifier applied to the tag, or `null` to omit it.
     *
     * @return string Enclosed content, or the content untouched for empty content or a disabled tag.
     */
    private function renderOptionalTag(
        array $attributes,
        string $content,
        UnitEnum|false $tag,
        string|null $id = null,
    ): string {
        if ($content === '' || $tag === false || $tag instanceof BackedEnum === false) {
            return $content;
        }

        if ($id !== null) {
            $attributes['id'] = $id;
        }

        if ($tag instanceof Inline) {
            return Html::inline($tag, $content, $attributes);
        }

        return Html::element($tag, $content, $attributes);
    }

    /**
     * Renders the prefix section.
     *
     * @return string Rendered prefix section, or an empty string without content.
     */
    private function renderPrefixTag(): string
    {
        return $this->renderOptionalTag($this->prefixAttributes, $this->prefix, $this->prefixTag);
    }

    /**
     * Renders the suffix section.
     *
     * @return string Rendered suffix section, or an empty string without content.
     */
    private function renderSuffixTag(): string
    {
        return $this->renderOptionalTag($this->suffixAttributes, $this->suffix, $this->suffixTag);
    }

    /**
     * Merges the themed layout resolved by {@see ControlLayout::resolve()} under field-local state.
     *
     * @throws ConfigException If a layout recipe cannot be applied or returns an incompatible carrier.
     *
     * @return static Field with the themed layout merged under field-local state.
     */
    private function resolveControlLayout(): static
    {
        if ($this->config === null) {
            return $this;
        }

        $layout = ControlLayout::resolve(
            $this->config,
            $this->configContext ?? new ComponentContext('field'),
            $this->controlType,
        );

        $field = clone $this;

        $field->enclosedByLabel = $layout->mergeEnclosedByLabel($this->enclosedByLabel);
        $field->inputContainerAttributes = $layout->mergeInputContainerAttributes($this->inputContainerAttributes);
        $field->inputContainerTag = $layout->mergeInputContainerTag($this->inputContainerTag);
        $field->inputTemplate = $layout->mergeInputTemplate($this->inputTemplate, $this->inputTemplateConfigured);
        $field->label = $layout->mergeLabel($this->label);
        $field->labelAttributes = $layout->mergeLabelAttributes($this->labelAttributes);
        $field->notLabel = $layout->mergeNotLabel($this->notLabel);

        return $field;
    }

    /**
     * Derives a semantic slot context while preserving every field qualifier and metadata value.
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

    /**
     * Converts a form model field config into ordered config calls.
     *
     * A bare value becomes a single positional argument, and a list becomes the ordered argument list. Associative
     * argument arrays are rejected because config calls are positional.
     *
     * @param array<array-key, mixed> $fieldConfig Bare values or positional argument lists indexed by method name.
     * @param string $property Name of the form model property owning the field config.
     *
     * @throws InvalidFieldConfig If an entry is not indexed by a method name or passes named arguments.
     *
     * @return Cookbook Ordered config calls converted from the field config entries.
     */
    private static function toCookbook(array $fieldConfig, string $property): Cookbook
    {
        $calls = [];

        foreach ($fieldConfig as $method => $arguments) {
            if (is_string($method) === false || $method === '') {
                throw InvalidFieldConfig::forMethodName($property);
            }

            if (is_array($arguments) === false) {
                $calls[] = new Call($method, $arguments);

                continue;
            }

            if (array_is_list($arguments) === false) {
                throw InvalidFieldConfig::forNamedArguments($method, $property);
            }

            $calls[] = new Call($method, ...$arguments);
        }

        return new Cookbook(...$calls);
    }

    /**
     * Stores a form control and selects its default input template unless one was explicitly configured.
     *
     * @param AttributesInterface&RenderableInterface $widget Form control stored on the field.
     *
     * @return static Field carrying the control and its input template.
     */
    private function withWidget(AttributesInterface&RenderableInterface $widget): static
    {
        $new = clone $this;
        $new->widget = $widget;

        if ($new->inputTemplateConfigured === false) {
            $new->inputTemplate = $widget instanceof CheckedStateInterface
                && ($widget instanceof ChoiceListInterface) === false
                    ? "{input}\n{label}"
                    : "{label}\n{input}";
        }

        return $new;
    }
}
