<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

use stdClass;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Form\{
    CheckboxList,
    InputCheckbox,
    InputEmail,
    InputPassword,
    InputRadio,
    InputText,
    RadioList,
    Select,
    TextArea,
};

/**
 * Data provider for {@see \UIAwesome\Html\Field\Tests\Factory\ControlFactoryTest} test cases.
 */
final class ControlFactoryProvider
{
    /**
     * @return iterable<string, array{string, class-string<FormControlInterface>}>
     */
    public static function defaultControls(): iterable
    {
        yield 'checkbox' => ['checkbox', InputCheckbox::class];
        yield 'checkbox list' => ['checkbox-list', CheckboxList::class];
        yield 'email' => ['email', InputEmail::class];
        yield 'password' => ['password', InputPassword::class];
        yield 'radio' => ['radio', InputRadio::class];
        yield 'radio list' => ['radio-list', RadioList::class];
        yield 'select' => ['select', Select::class];
        yield 'text' => ['text', InputText::class];
        yield 'textarea' => ['textarea', TextArea::class];
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function invalidComponents(): iterable
    {
        yield 'different component' => ['button'];
        yield 'empty type' => ['field.control.'];
        yield 'prefix mismatch with registered suffix' => ['FIELD.CONTROL.text'];
        yield 'qualified type' => ['field.control.email.compact'];
        yield 'unknown type' => ['field.control.unknown'];
    }

    /**
     * @return iterable<string, array{array<array-key, mixed>}>
     */
    public static function invalidDefinitions(): iterable
    {
        yield 'invalid class' => [['custom' => stdClass::class]];
        yield 'invalid value' => [['custom' => 1]];
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function invalidTypes(): iterable
    {
        yield 'empty' => [''];
        yield 'invalid UTF-8' => ["\xFF"];
        yield 'qualified' => ['custom.editor'];
        yield 'space' => ['custom editor'];
        yield 'tab' => ["custom\teditor"];
    }
}
