<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\FormModel\BaseFormModel;

/**
 * Stub form model returning an empty label for the `email` property.
 */
final class EmptyLabelForm extends BaseFormModel
{
    public mixed $email = '';

    public function getLabels(): array
    {
        return [
            'email' => '',
        ];
    }
}
