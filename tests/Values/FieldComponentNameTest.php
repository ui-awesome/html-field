<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Values;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use UIAwesome\Html\Core\Config\{ComponentContext, Config};
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{BasicForm, RecordingTheme};
use UIAwesome\Html\Field\Values\FieldComponentName;
use UIAwesome\Html\Form\InputText;

use function array_keys;
use function array_map;
use function array_unique;
use function array_values;
use function is_array;
use function is_string;
use function sort;

/**
 * Unit tests for the {@see FieldComponentName} enum declaring the component identifiers emitted by the field.
 */
#[Group('values')]
final class FieldComponentNameTest extends TestCase
{
    public function testDeclaresExactlyTheComponentNamesEmittedForTheDefaultBaseAndRegistry(): void
    {
        $definitions = (new ReflectionProperty(ControlFactory::class, 'definitions'))->getValue(new ControlFactory());

        if (is_array($definitions) === false) {
            self::fail(
                'The default control registry must be an array.'
            );
        }

        $theme = new RecordingTheme();

        foreach (array_keys($definitions) as $type) {
            if (is_string($type) === false) {
                self::fail('Every default control type must be a string.');
            }

            Field::tag()
                ->control($type)
                ->config(new Config($theme))
                ->formModel(new BasicForm())
                ->property('username')
                ->render();
        }

        Field::tag()
            ->input(InputText::tag())
            ->config(new Config($theme))
            ->formModel(new BasicForm())
            ->property('username')
            ->render();

        $emitted = array_values(
            array_unique(
                array_map(
                    static fn(ComponentContext $context): string => $context->component,
                    $theme->contexts,
                ),
            ),
        );
        $declared = array_map(
            static fn(FieldComponentName $case): string => $case->value,
            FieldComponentName::cases(),
        );

        sort($emitted);
        sort($declared);

        self::assertSame(
            $declared,
            $emitted,
            'Emitted component names and enum values must match exactly.',
        );
    }
}
