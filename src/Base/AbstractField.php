<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Base;

use BackedEnum;
use UIAwesome\FormModel\FormModelInterface;
use UIAwesome\Html\Attribute\Global\{HasClass, HasId};
use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Contracts\Attribute\AttributesInterface;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Field\Exception\AttributeNotSet;
use UIAwesome\Html\Field\Mixin\{
    CanBeEnclosedByLabel,
    HasError,
    HasHint,
    HasInputContainer,
    HasInputTemplate,
    HasValidateClass,
};
use UIAwesome\Html\Form\{InputCheckbox, InputRadio, InputText};
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

use function array_key_exists;
use function implode;
use function is_array;
use function is_string;
use function method_exists;
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
     * Form model providing labels, hints, values, and per-property configuration.
     */
    private FormModelInterface|null $formModel = null;
    /**
     * Name of the form model property represented by the field.
     */
    private string $property = '';
    /**
     * Form control rendered by the field, or `null` until a control is configured.
     */
    private (AttributesInterface&RenderableInterface)|null $widget = null;

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
        $new = clone $this;
        $new->widget = $new->applyDefinitionsToWidget($widget, $new->getFieldConfig());

        if ($widget instanceof InputCheckbox || $widget instanceof InputRadio) {
            $new->inputTemplate = "{input}\n{label}";
        }

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
     * An explicit value takes precedence over the value resolved from the form model.
     *
     * Usage example:
     * ```php
     * $field = \UIAwesome\Html\Field\Field::tag()->value('admin');
     * ```
     *
     * @param mixed $value Value serialized into the form control.
     */
    public function value(mixed $value): static
    {
        return $this->addAttribute(ElementAttribute::VALUE, $value);
    }

    /**
     * Returns the default configuration applied when the field is created.
     *
     * @return array<string, mixed> Default container tag, control, and templates indexed by configuration method.
     */
    protected function loadDefault(): array
    {
        return [
            'containerTag' => [Block::DIV],
            'input' => [InputText::tag()],
            'inputTemplate' => ["{label}\n{input}"],
            'template' => ["{prefix}\n{field}\n{suffix}\n{hint}\n{error}"],
        ];
    }

    /**
     * Renders the field, or an empty string until the form model, property, and control are configured.
     */
    protected function run(): string
    {
        $formModel = $this->formModel;
        $property = $this->property;
        $widget = $this->widget;

        if ($formModel === null || $property === '' || $widget === null) {
            return '';
        }

        $widget = $this->configureWidget($widget, $formModel, $property);

        return $this->renderOptionalTag(
            $this->containerAttributes,
            $this->renderField($widget, $formModel, $property),
            $this->containerTag,
        );
    }

    /**
     * Applies form model field config entries to the control by calling matching methods.
     *
     * @param array<array-key, mixed> $definitions Method arguments indexed by control method name.
     */
    private function applyDefinitionsToWidget(
        AttributesInterface&RenderableInterface $widget,
        array $definitions,
    ): AttributesInterface&RenderableInterface {
        foreach ($definitions as $action => $arguments) {
            $method = (string) $action;

            if (method_exists($widget, $method)) {
                /** @phpstan-ignore method.dynamicName */
                $configured = $widget->{$method}(...(is_array($arguments) ? $arguments : [$arguments]));

                if ($configured instanceof $widget) {
                    $widget = $configured;
                }
            }
        }

        return $widget;
    }

    /**
     * Transfers the field attributes to the control and links the hint through `aria-describedby`.
     */
    private function applyToAttributes(
        AttributesInterface&RenderableInterface $widget,
    ): AttributesInterface&RenderableInterface {
        if ($this->hintContent !== '' && $this->hintId !== '') {
            $widget = $widget->addAttribute('aria-describedby', $this->hintId);
        }

        return $widget->attributes($this->getAttributes());
    }

    /**
     * Applies the form model placeholder to controls supporting it.
     */
    private function applyToPlaceholder(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        if (method_exists($widget, 'placeholder')) {
            $configured = $widget->placeholder($formModel->getPlaceholder($property));

            if ($configured instanceof $widget) {
                return $configured;
            }
        }

        return $widget;
    }

    /**
     * Applies the resolved value through the first control method supporting it.
     */
    private function applyToValue(
        AttributesInterface&RenderableInterface $widget,
        FormModelInterface $formModel,
        string $property,
    ): AttributesInterface&RenderableInterface {
        $value = $this->getAttribute('value') ?? $formModel->getValue($property);

        foreach (['content', 'checked', 'src', 'value'] as $method) {
            if (method_exists($widget, $method) === false) {
                continue;
            }

            if (
                $method === 'checked'
                && $widget->getAttribute('value') === null
                && (method_exists($widget, 'isList') === false || $widget->isList() !== true)
            ) {
                continue;
            }

            if (($method === 'content' || $method === 'src') && is_string($value) === false) {
                continue;
            }

            /** @phpstan-ignore method.dynamicName */
            $configured = $widget->{$method}($value);

            if ($configured instanceof $widget) {
                if ($method === 'src' && array_key_exists('value', $this->getAttributes())) {
                    $configured = $configured->removeAttribute('value');
                }

                return $configured;
            }
        }

        return $widget;
    }

    /**
     * Configures the field from the form model once both the model and the property are set.
     *
     * @throws AttributeNotSet If the property does not exist in the form model.
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

        /** @var static $configured */
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

        $fieldConfig = $formModel->getFieldConfig($property);

        /** @var static $configured */
        $configured = SimpleFactory::configure($configured, $fieldConfig);

        if ($configured->widget !== null) {
            $configured->widget = $configured->applyDefinitionsToWidget($configured->widget, $fieldConfig);
        }

        return $configured;
    }

    /**
     * Applies attributes, placeholder, value, and validation state classes to the control.
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
     * Returns the form model field config for the configured property.
     *
     * @return array<array-key, mixed> Field config entries, or an empty array until model and property are set.
     */
    private function getFieldConfig(): array
    {
        return $this->formModel === null || $this->property === ''
            ? []
            : $this->formModel->getFieldConfig($this->property);
    }

    /**
     * Returns the first property error, or every error joined by line breaks.
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
     */
    private function isListWidget(AttributesInterface&RenderableInterface $widget): bool
    {
        return method_exists($widget, 'isList') && $widget->isList() === true;
    }

    /**
     * Renders the error section, falling back to the configured error content.
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
     */
    private function renderHintTag(): string
    {
        return $this->renderOptionalTag($this->hintAttributes, $this->hintContent, $this->hintTag, $this->hintId);
    }

    /**
     * Renders the label and control through the input template, enclosed by the input container.
     */
    private function renderInputField(AttributesInterface&RenderableInterface $widget): string
    {
        [$widget, $label] = $this->renderLabelTag($widget);

        $rendered = Template::render(
            $this->inputTemplate,
            [
                '{input}' => $this->enclosedByLabel && $this->isListWidget($widget) === false
                    ? ''
                    : $widget->render(),
                '{label}' => $label,
            ],
        );

        return $this->renderOptionalTag(
            $this->inputContainerAttributes,
            $rendered,
            $this->inputContainerTag,
        );
    }

    /**
     * Renders the label, enclosing the control when configured.
     *
     * @return array{AttributesInterface&RenderableInterface, string} Control to render and the rendered label markup.
     */
    private function renderLabelTag(AttributesInterface&RenderableInterface $widget): array
    {
        if ($this->isLabel() === false) {
            return [$widget, ''];
        }

        $id = $this->getAttribute('id');
        $for = $this->getLabelAttribute('for', is_string($id) ? $id : null);

        $for = is_string($for) ? $for : null;

        $isList = $this->isListWidget($widget);

        if ($isList) {
            $for = null;
        }

        $label = Label::tag()
            ->attributes($this->getLabelAttributes())
            ->for($for);

        if ($this->enclosedByLabel) {
            if ($isList && method_exists($widget, 'enclosedByLabel')) {
                $configured = $widget->enclosedByLabel();

                if ($configured instanceof $widget) {
                    return [$configured, $label->content($this->getLabel())->render()];
                }
            }

            $content = $widget instanceof InputCheckbox || $widget instanceof InputRadio
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
     */
    private function renderPrefixTag(): string
    {
        return $this->renderOptionalTag($this->prefixAttributes, $this->prefix, $this->prefixTag);
    }

    /**
     * Renders the suffix section.
     */
    private function renderSuffixTag(): string
    {
        return $this->renderOptionalTag($this->suffixAttributes, $this->suffix, $this->suffixTag);
    }
}
