<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Base;

use LogicException;
use PHPForge\Widget\Element;
use PHPForge\Widget\Factory\SimpleFactory;
use UIAwesome\{
    FormModel\FormModelInterface,
    Html\Attribute\HasId,
    Html\Attribute\HasName,
    Html\Attribute\HasValue,
    Html\Concern\HasAttributes,
    Html\Concern\HasContainerCollection,
    Html\Concern\HasLabelCollection,
    Html\Concern\HasPrefixCollection,
    Html\Concern\HasSuffixCollection,
    Html\Concern\HasTemplate,
    Html\Field\Concern\HasError,
    Html\Field\Concern\HasHint,
    Html\Field\Concern\HasInputContainer,
    Html\Field\Concern\HasInputTemplate,
    Html\Field\Concern\HasValidateClass,
    Html\Field\Exception\AttributeNotSet,
    Html\FormControl\Input\Checkbox,
    Html\FormControl\Input\CheckboxList,
    Html\FormControl\Input\Hidden,
    Html\FormControl\Input\Radio,
    Html\FormControl\Input\RadioList,
    Html\FormControl\Input\Text,
    Html\FormControl\Label,
    Html\Helper\Template,
    Html\Helper\Utils,
    Html\Interop\AriaDescribedByInterface,
    Html\Interop\CheckedInterface,
    Html\Interop\ContentInterface,
    Html\Interop\InputInterface,
    Html\Interop\LabelInterface,
    Html\Interop\PlaceholderInterface,
    Html\Interop\SrcInterface,
    Html\Interop\ValueInterface,
    Html\Tag
};

use function is_string;
use function preg_replace;
use function implode;

/**
 * Represents a field.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
abstract class AbstractField extends Element
{
    use HasAttributes;
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
    use HasValue;

    protected array $attributes = [];
    protected string $class = '';
    protected bool $classOverride = false;
    protected bool $enclosedByLabel = false;
    private InputInterface $widget;

    /**
     * @psalm-param array<string, mixed> $definitions
     */
    public function __construct(
        public readonly FormModelInterface $formModel,
        public readonly string $property,
        array $definitions = []
    ) {
        if ($this->formModel->hasProperty($this->property) === false) {
            throw new AttributeNotSet();
        }

        /** @psalm-var array<string, mixed> $definitions */
        $definitions += $this->formModel->getWidgetConfig();

        parent::__construct($definitions);
    }

    /**
     * Set the `CSS` `HTML` field class attribute.
     *
     * @param string $value The `CSS` attribute of the widget.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified class value.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function class(string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->class = $value;
        $new->classOverride = $override;

        return $new;
    }

    /**
     * Set the current instance as being enclosed by a label.
     *
     * @param bool $value The value to set.
     *
     * @return self A new instance of of the current class with the specified enclosed by label property.
     */
    public function enclosedByLabel(bool $value): self
    {
        $new = clone $this;
        $new->enclosedByLabel = $value;

        return $new;
    }

    public function input(InputInterface $widget): self
    {
        /** @psalm-var array<string, mixed> $definitionProperty */
        $definitionProperty = $this->formModel->getWidgetConfigByProperty($this->property);

        /** @var InputInterface $widget */
        $widget = SimpleFactory::configure($widget, $definitionProperty);

        $new = clone $this;
        $new->widget = $widget;

        if ($widget instanceof Checkbox || $widget instanceof Radio) {
            $new->inputTemplate = '{input}\n{label}';
        }

        return $new;
    }

    /**
     * Loads the default definitions for the field.
     *
     * @return array An associative array of default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        $modelName = $this->formModel->getModelName();
        $id = Utils::generateInputId($modelName, $this->property);

        return [
            'containerTag()' => [],
            'hintContent()' => [$this->formModel->getHintByProperty($this->property)],
            'hintId()' => ["$id-help"],
            'id()' => [$id],
            'input()' => [Text::widget()],
            'inputTemplate()' => ['{label}\n{input}'],
            'label()' => [$this->formModel->getLabelByProperty($this->property)],
            'name()' => [Utils::generateInputName($modelName, $this->property)],
            'template()' => ['{prefix}\n{field}\n{suffix}\n{hint}\n{error}'],
        ];
    }

    /**
     * Renders the field.
     *
     * @throws LogicException If the widget is not set.
     *
     * @return string The rendered field.
     */
    protected function run(): string
    {
        $widget = $this->configureWidget($this->widget);

        return $this->renderTag($this->containerAttributes, $this->renderField($widget), $this->containerTag);
    }

    private function applyToAttributes(InputInterface $widget): InputInterface
    {
        if (
            $widget instanceof AriaDescribedByInterface &&
            ($this->formModel->getHintByProperty($this->property) !== '' || $this->hintContent !== '')
        ) {
            $widget = $widget->ariaDescribedBy(true);
        }

        $widget = $this->formModel->applyToHtmlRulesByProperty($widget, $this->property);

        return $widget->attributes($this->attributes)->class($this->class, $this->classOverride);
    }

    private function applyToPlaceholder(InputInterface $widget): InputInterface
    {
        if (!$widget instanceof PlaceholderInterface) {
            return $widget;
        }

        return $widget->placeholder($this->formModel->getPlaceholderByProperty($this->property));
    }

    private function applyToValue(InputInterface $widget): InputInterface
    {
        /** @psalm-var array|null|scalar $value */
        $value = $this->getValue() ?? $this->formModel->getPropertyValue($this->property);

        if ($widget instanceof ContentInterface && is_string($value) === true) {
            return $widget->content($value);
        }

        if ($widget instanceof CheckedInterface) {
            return $widget->checked($value);
        }

        if ($widget instanceof SrcInterface && is_string($value) === true) {
            return $widget->src($value);
        }

        if ($widget instanceof ValueInterface) {
            return $widget->value($value);
        }

        return $widget;
    }

    /**
     * Configures the widget associated with the field.
     *
     * @param InputInterface $widget The widget to be configured.
     *
     * @return InputInterface The configured widget.
     */
    private function configureWidget(InputInterface $widget): InputInterface
    {
        $widget = $this->applyToAttributes($widget);
        $widget = $this->applyToPlaceholder($widget);
        $widget = $this->applyToValue($widget);

        return $this->handleErrorAndValidation($widget);
    }

    private function getPropertyError(bool $showAllErrors): string
    {
        if ($this->formModel->hasPropertyError($this->property) === false) {
            return '';
        }

        if ($showAllErrors) {
            /** @psalm-var string[] $errors */
            $errors = $this->formModel->getPropertyError($this->property, false);

            return implode(PHP_EOL, $errors);
        }

        $firstError = $this->formModel->getPropertyError($this->property, true);

        return is_string($firstError) ? $firstError : '';
    }

    private function handleErrorAndValidation(InputInterface $widget): InputInterface
    {
        if ($this->formModel->hasPropertyError($this->property)) {
            $widget = $widget->class($this->invalidClass);
        }

        if ($this->formModel->hasPropertyValidate($this->property)) {
            $widget = $widget->class($this->validClass);
        }

        return $widget;
    }

    private function renderErrorTag(): string
    {
        $error = $this->getPropertyError($this->showAllErrors);

        if ($error === '') {
            $error = $this->errorContent;
        }

        return $this->renderTag($this->errorAttributes, $error, $this->errorTag);
    }

    private function renderField(InputInterface $widget): string
    {
        return preg_replace(
            '/^\h*\v+/m',
            '',
            Template::render(
                $this->template,
                [
                    '{error}' => $this->renderErrorTag(),
                    '{field}' => $this->renderInputField($widget),
                    '{hint}' => $this->renderHintTag(),
                    '{prefix}' => $this->renderPrefixTag(),
                    '{suffix}' => $this->renderSuffixTag(),
                ],
            )
        );
    }

    public function renderHintTag(): string
    {
        return $this->renderTag($this->hintAttributes, $this->hintContent, $this->hintTag, $this->hintId);
    }

    private function renderInputField(InputInterface $widget): string
    {
        /** @var InputInterface $widget  */
        [$widget, $label] = $this->renderLabelTag($widget);

        $renderInput = Template::render(
            $this->inputTemplate,
            [
                '{input}' => $widget->render(),
                '{label}' => $label,
            ],
        );

        return $this->renderTag($this->inputContainerAttributes, $renderInput, $this->inputContainerTag);
    }

    /**
     * Renders the label tag.
     *
     * @return array An array containing the widget and the label tag.
     */
    private function renderLabelTag(InputInterface $widget): array
    {
        if ($this->disableLabel === true) {
            return [$widget, ''];
        }

        $attributes = $this->labelAttributes;
        $for = $this->labelFor ?? $this->getId();

        $labelTag = Label::widget()->attributes($attributes)->for($for);

        if ($widget instanceof RadioList || $widget instanceof CheckboxList) {
            $labelTag = $labelTag->for(null);
        }

        if (!$widget instanceof Hidden && $this->enclosedByLabel === false) {
            return [$widget, $labelTag->content($this->label)];
        }

        return $widget instanceof LabelInterface
            ? [$widget->enclosedByLabel(true)->labelAttributes($attributes)->label($this->label)->labelFor($for), '']
            : [$labelTag->content($widget), ''];
    }

    private function renderPrefixTag(): string
    {
        return $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag);
    }

    private function renderSuffixTag(): string
    {
        return $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag);
    }

    private function renderTag(array $attributes, string $content, false|string $tag, null|string $id = null): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        $tag = Tag::widget()->attributes($attributes)->content($content)->tagName($tag);

        return $id !== null ? $tag->id($id)->render() : $tag->render();
    }
}
