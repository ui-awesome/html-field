<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Exception\{AttributeNotSet, Message};
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\BasicForm;

/**
 * Unit tests for the {@see AttributeNotSet} exception raised by {@see Field}.
 */
#[Group('exception')]
final class ExceptionTest extends TestCase
{
    public function testThrowAttributeNotSetForUnknownProperty(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage(
            Message::ATTRIBUTE_NOT_SET->getMessage('attribute'),
        );

        Field::tag()->formModel(new BasicForm())->property('attribute');
    }
}
