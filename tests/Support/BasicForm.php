<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

final class BasicForm extends BaseFormModel
{
    public mixed $agree = '';
    public mixed $amount = '';
    public mixed $attachment = '';
    public mixed $color = '';
    public mixed $content = '';
    public mixed $dateOfBirth = '';
    public mixed $email = '';
    public mixed $fruits = [];
    public mixed $hint = null;
    public mixed $image = '';
    public mixed $label = null;
    public mixed $monthOfBirth = '';
    public mixed $password = '';
    public mixed $placeholder = '';
    public mixed $timeOfBirth = '';
    public mixed $url = '';
    public mixed $username = '';
    public mixed $weekOfBirth = '';

    /**
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return [
            'agree' => $this->agree,
            'amount' => $this->amount,
            'attachment' => $this->attachment,
            'color' => $this->color,
            'content' => $this->content,
            'dateOfBirth' => $this->dateOfBirth,
            'email' => $this->email,
            'fruits' => $this->fruits,
            'hint' => $this->hint,
            'image' => $this->image,
            'label' => $this->label,
            'monthOfBirth' => $this->monthOfBirth,
            'password' => $this->password,
            'placeholder' => $this->placeholder,
            'timeOfBirth' => $this->timeOfBirth,
            'url' => $this->url,
            'username' => $this->username,
            'weekOfBirth' => $this->weekOfBirth,
        ];
    }

    public function getHints(): array
    {
        return [
            'hint' => 'This is a hint.',
        ];
    }

    public function getLabels(): array
    {
        return [
            'label' => 'This is a label.',
        ];
    }

    public function getPlaceholders(): array
    {
        return [
            'placeholder' => 'This is a placeholder.',
        ];
    }
}
