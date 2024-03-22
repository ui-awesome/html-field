<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\AbstractFormModel;

final class ConfigForm extends AbstractFormModel
{
    private string $name = '';

    public function getWidgetConfig(): array
    {
        return [
            'class()' => ['form-control'],
        ];
    }

    public function getWidgetConfigByProperties(): array
    {
        return [
            'name' => [
                'class()' => ['custom-class'],
            ],
        ];
    }
}
