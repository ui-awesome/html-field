<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

final class ConfigForm extends BaseFormModel
{
    public string $name = '';

    /**
     * @return array<string, string>
     */
    public function __debugInfo(): array
    {
        return ['name' => $this->name];
    }

    /**
     * @return array<string, array<int|string, mixed>>
     */
    public function getFieldConfigs(): array
    {
        return [
            'name' => [
                0 => null,
                'class' => ['custom-class form-control'],
                'maxlength' => 10,
            ],
        ];
    }
}
