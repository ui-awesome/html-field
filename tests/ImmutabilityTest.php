<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\{Html\Field\Field, Html\Field\Tests\Support\BasicForm, Html\FormControl\Input\Text};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends \PHPUnit\Framework\TestCase
{
    public function testInmutability(): void
    {
        $field = Field::widget(new BasicForm(), 'amount');

        $this->assertNotSame($field, $field->input(Text::widget()));
    }
}
