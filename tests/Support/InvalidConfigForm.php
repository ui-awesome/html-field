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
     * Numeric-string method name that PHP converts to an integer array key.
     *
     * @phpstan-ignore property.unusedType (The integer type documents the generated array key.)
     */
    private int|string $numericMethodName = '0';

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
     * @return array<string, array<array-key, mixed>>
     *
     * @phpstan-ignore method.childReturnType, method.childReturnType
     * (This fixture deliberately violates both inherited form-model contracts.)
     */
    public function getFieldConfigs(): array
    {
        return [
            'emptyMethodName' => ['' => 'custom-class'],
            'namedArguments' => ['class' => ['value' => 'custom-class']],
            'nonStringMethodName' => [$this->numericMethodName => null],
            'unknownMethod' => ['maxlenght' => 10],
        ];
    }
}
