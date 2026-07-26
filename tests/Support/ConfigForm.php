<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

/**
 * Stub form model providing a per-property field config for configuration tests.
 */
final class ConfigForm extends BaseFormModel
{
    public string $name = '';
    public string $ordered = '';
    public string $overrideChecked = '';
    public string $overrideId = '';
    public string $overrideName = '';
    public string $overridePlaceholder = '';
    public string $overrideValue = 'model-value';
    public string $textArea = '';

    /**
     * @return array<string, string>
     */
    public function __debugInfo(): array
    {
        return [
            'name' => $this->name,
            'ordered' => $this->ordered,
            'overrideChecked' => $this->overrideChecked,
            'overrideId' => $this->overrideId,
            'overrideName' => $this->overrideName,
            'overridePlaceholder' => $this->overridePlaceholder,
            'overrideValue' => $this->overrideValue,
            'textArea' => $this->textArea,
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getFieldConfigs(): array
    {
        return [
            'name' => [
                'class' => ['custom-class form-control'],
                'maxlength' => 10,
            ],
            'ordered' => [
                'maxlength' => 10,
                'class' => ['custom-class'],
            ],
            'overrideChecked' => [
                'checked' => true,
            ],
            'overrideId' => [
                'id' => 'custom-id',
            ],
            'overrideName' => [
                'name' => 'custom-name',
            ],
            'overridePlaceholder' => [
                'placeholder' => 'Custom placeholder.',
            ],
            'overrideValue' => [
                'value' => 'custom-value',
            ],
            'textArea' => [
                'class' => ['custom-class'],
                'rows' => 5,
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getPlaceholders(): array
    {
        return ['overridePlaceholder' => 'Model placeholder.'];
    }
}
