<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

/**
 * Stub form model exposing the unsupported field config shapes rejected by the field config adapter.
 */
final class InvalidConfigForm extends BaseFormModel
{
    public string $emptyMethodName = '';
    public string $namedArguments = '';
    public string $nonStringMethodName = '';
    public string $unknownMethod = '';

    /**
     * @return array<string, string>
     */
    public function __debugInfo(): array
    {
        return [
            'emptyMethodName' => $this->emptyMethodName,
            'namedArguments' => $this->namedArguments,
            'nonStringMethodName' => $this->nonStringMethodName,
            'unknownMethod' => $this->unknownMethod,
        ];
    }

    /**
     * @return array<string, array<int|string, mixed>>
     */
    public function getFieldConfigs(): array
    {
        return [
            'emptyMethodName' => ['' => 'custom-class'],
            'namedArguments' => ['class' => ['value' => 'custom-class']],
            'nonStringMethodName' => [0 => null],
            'unknownMethod' => ['maxlenght' => 10],
        ];
    }
}
