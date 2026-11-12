<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Values;

/**
 * Represents the component identifiers this package emits for {@see \UIAwesome\Html\Core\Config\ComponentContext}
 * when a field uses the default `field` base context and the default
 * {@see \UIAwesome\Html\Field\Factory\ControlFactory} registry.
 *
 * Match the backing value against `ComponentContext::$component` in a theme to resolve recipes for a field slot.
 * Identifiers composed from a custom base context, such as `app.field`, or from control types registered through
 * {@see \UIAwesome\Html\Field\Factory\ControlFactory::with()} are not covered and remain plain strings.
 */
enum FieldComponentName: string
{
    /**
     * `field` — Identifies the field itself, configured before its slots.
     */
    case FIELD = 'field';

    /**
     * `field.container` — Identifies the field container slot.
     */
    case FIELD_CONTAINER = 'field.container';

    /**
     * `field.control` — Identifies the control slot of an input supplied through
     * {@see \UIAwesome\Html\Field\Base\AbstractField::input()}.
     */
    case FIELD_CONTROL = 'field.control';

    /**
     * `field.control.checkbox` — Identifies the `checkbox` semantic control.
     */
    case FIELD_CONTROL_CHECKBOX = 'field.control.checkbox';

    /**
     * `field.control.checkbox-list` — Identifies the `checkbox-list` semantic control.
     */
    case FIELD_CONTROL_CHECKBOX_LIST = 'field.control.checkbox-list';

    /**
     * `field.control.email` — Identifies the `email` semantic control.
     */
    case FIELD_CONTROL_EMAIL = 'field.control.email';

    /**
     * `field.control.password` — Identifies the `password` semantic control.
     */
    case FIELD_CONTROL_PASSWORD = 'field.control.password';

    /**
     * `field.control.radio` — Identifies the `radio` semantic control.
     */
    case FIELD_CONTROL_RADIO = 'field.control.radio';

    /**
     * `field.control.radio-list` — Identifies the `radio-list` semantic control.
     */
    case FIELD_CONTROL_RADIO_LIST = 'field.control.radio-list';

    /**
     * `field.control.select` — Identifies the `select` semantic control.
     */
    case FIELD_CONTROL_SELECT = 'field.control.select';

    /**
     * `field.control.text` — Identifies the `text` semantic control.
     */
    case FIELD_CONTROL_TEXT = 'field.control.text';

    /**
     * `field.control.textarea` — Identifies the `textarea` semantic control.
     */
    case FIELD_CONTROL_TEXTAREA = 'field.control.textarea';

    /**
     * `field.error` — Identifies the error slot.
     */
    case FIELD_ERROR = 'field.error';

    /**
     * `field.hint` — Identifies the hint slot.
     */
    case FIELD_HINT = 'field.hint';

    /**
     * `field.input-container.checkbox` — Identifies the input container layout slot of the `checkbox` control.
     */
    case FIELD_INPUT_CONTAINER_CHECKBOX = 'field.input-container.checkbox';

    /**
     * `field.input-container.checkbox-list` — Identifies the input container layout slot of the `checkbox-list`
     * control.
     */
    case FIELD_INPUT_CONTAINER_CHECKBOX_LIST = 'field.input-container.checkbox-list';

    /**
     * `field.input-container.email` — Identifies the input container layout slot of the `email` control.
     */
    case FIELD_INPUT_CONTAINER_EMAIL = 'field.input-container.email';

    /**
     * `field.input-container.password` — Identifies the input container layout slot of the `password` control.
     */
    case FIELD_INPUT_CONTAINER_PASSWORD = 'field.input-container.password';

    /**
     * `field.input-container.radio` — Identifies the input container layout slot of the `radio` control.
     */
    case FIELD_INPUT_CONTAINER_RADIO = 'field.input-container.radio';

    /**
     * `field.input-container.radio-list` — Identifies the input container layout slot of the `radio-list` control.
     */
    case FIELD_INPUT_CONTAINER_RADIO_LIST = 'field.input-container.radio-list';

    /**
     * `field.input-container.select` — Identifies the input container layout slot of the `select` control.
     */
    case FIELD_INPUT_CONTAINER_SELECT = 'field.input-container.select';

    /**
     * `field.input-container.text` — Identifies the input container layout slot of the `text` control.
     */
    case FIELD_INPUT_CONTAINER_TEXT = 'field.input-container.text';

    /**
     * `field.input-container.textarea` — Identifies the input container layout slot of the `textarea` control.
     */
    case FIELD_INPUT_CONTAINER_TEXTAREA = 'field.input-container.textarea';

    /**
     * `field.label` — Identifies the label layout slot shared by every control.
     */
    case FIELD_LABEL = 'field.label';

    /**
     * `field.label.checkbox` — Identifies the label layout slot of the `checkbox` control.
     */
    case FIELD_LABEL_CHECKBOX = 'field.label.checkbox';

    /**
     * `field.label.checkbox-list` — Identifies the label layout slot of the `checkbox-list` control.
     */
    case FIELD_LABEL_CHECKBOX_LIST = 'field.label.checkbox-list';

    /**
     * `field.label.email` — Identifies the label layout slot of the `email` control.
     */
    case FIELD_LABEL_EMAIL = 'field.label.email';

    /**
     * `field.label.password` — Identifies the label layout slot of the `password` control.
     */
    case FIELD_LABEL_PASSWORD = 'field.label.password';

    /**
     * `field.label.radio` — Identifies the label layout slot of the `radio` control.
     */
    case FIELD_LABEL_RADIO = 'field.label.radio';

    /**
     * `field.label.radio-list` — Identifies the label layout slot of the `radio-list` control.
     */
    case FIELD_LABEL_RADIO_LIST = 'field.label.radio-list';

    /**
     * `field.label.select` — Identifies the label layout slot of the `select` control.
     */
    case FIELD_LABEL_SELECT = 'field.label.select';

    /**
     * `field.label.text` — Identifies the label layout slot of the `text` control.
     */
    case FIELD_LABEL_TEXT = 'field.label.text';

    /**
     * `field.label.textarea` — Identifies the label layout slot of the `textarea` control.
     */
    case FIELD_LABEL_TEXTAREA = 'field.label.textarea';

    /**
     * `field.prefix` — Identifies the prefix slot.
     */
    case FIELD_PREFIX = 'field.prefix';

    /**
     * `field.suffix` — Identifies the suffix slot.
     */
    case FIELD_SUFFIX = 'field.suffix';
}
