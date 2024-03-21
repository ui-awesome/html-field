<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\AbstractFormModel;

final class BasicForm extends AbstractFormModel
{
    private string|bool|int|null $agree = '';
    private null|int|string $amount = '';
    private null|string|array $attachment = '';
    private null|string $color = '';
    private null|string $content = '';
    private null|string $dateOfBirth = '';
    private null|string $email = '';
    private array|int|string|null $fruits = [];
    private null|string $image = '';
    private array|string|null $label = null;
    private array|string|null $hint = null;
    private null|string $password = '';
    private string $placeholder = '';
    private null|string $monthOfBirth = '';
    private null|string $url = '';
    private string|null $username = '';
    private string $server = '';
    private string $textArea = '';
    private null|string $timeOfBirth = '';
    private null|string $weekOfBirth = '';

    public function getLabels(): array
    {
        return [
            'label' => 'This is a label.',
        ];
    }

    public function getHints(): array
    {
        return [
            'hint' => 'This is a hint.',
        ];
    }

    public function getPlaceholders(): array
    {
        return [
            'placeholder' => 'This is a placeholder.',
        ];
    }
}
