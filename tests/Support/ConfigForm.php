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
    public string $textArea = '';

    /**
     * @return array<string, string>
     */
    public function __debugInfo(): array
    {
        return [
            'name' => $this->name,
            'ordered' => $this->ordered,
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
            'textArea' => [
                'class' => ['custom-class'],
                'rows' => 5,
            ],
        ];
    }
}
