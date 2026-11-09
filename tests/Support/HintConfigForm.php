<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

/**
 * Provides final description overrides without relying on model clone fixes.
 */
final class HintConfigForm extends BaseFormModel
{
    public string $hint = '';

    /**
     * @param array<string, mixed> $config Final control configuration.
     */
    public function __construct(private readonly array $config) {}

    public function getFieldConfigs(): array
    {
        return ['hint' => $this->config];
    }
}
