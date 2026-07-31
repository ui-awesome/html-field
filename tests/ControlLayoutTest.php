<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Field\ControlLayout;
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see ControlLayout} resolving and merging themed layout state for the final semantic control.
 */
#[Group('config')]
final class ControlLayoutTest extends TestCase
{
    public function testMergeFillsThemedStateIntoUnsetLocalState(): void
    {
        $layout = (new ControlLayout())
            ->enclosedByLabel()
            ->inputContainerAttributes(['data-role' => 'themed'])
            ->inputContainerTag(Block::DIV)
            ->inputTemplate("{label}\n{input}")
            ->label('Themed label')
            ->labelClass('themed-label')
            ->notLabel();

        self::assertTrue(
            $layout->mergeEnclosedByLabel(null),
            'Themed enclosure must fill the unset local flag.',
        );
        self::assertSame(
            ['class' => 'local', 'data-role' => 'themed'],
            $layout->mergeInputContainerAttributes(['class' => 'local']),
            'Themed attributes must fill only missing keys.',
        );
        self::assertSame(
            Block::DIV,
            $layout->mergeInputContainerTag(null),
            'Themed tag must fill the unset local tag.',
        );
        self::assertSame(
            "{label}\n{input}",
            $layout->mergeInputTemplate("{input}\n{label}", false),
            'Themed template must replace the derived local template.',
        );
        self::assertSame(
            'Themed label',
            $layout->mergeLabel(''),
            'Themed text must fill the empty local label.',
        );
        self::assertSame(
            ['for' => 'local-id', 'class' => 'themed-label'],
            $layout->mergeLabelAttributes(['for' => 'local-id']),
            'Themed attributes must fill only missing keys.',
        );
        self::assertTrue(
            $layout->mergeNotLabel(null),
            'Themed suppression must disable the label.',
        );
    }

    public function testMergePrefersLocalStateOverThemedState(): void
    {
        $layout = (new ControlLayout())
            ->enclosedByLabel()
            ->inputContainerClass('themed-container')
            ->inputContainerTag(Block::DIV)
            ->inputTemplate("{label}\n{input}")
            ->label('Themed label')
            ->labelClass('themed-label')
            ->notLabel();

        self::assertFalse(
            $layout->mergeEnclosedByLabel(false),
            'Local `false` must override the themed enclosure.',
        );
        self::assertSame(
            ['class' => 'local-container'],
            $layout->mergeInputContainerAttributes(['class' => 'local-container']),
            'Local class must replace the themed class for the same key.',
        );
        self::assertFalse(
            $layout->mergeInputContainerTag(false),
            'Local `false` must override the themed tag.',
        );
        self::assertSame(
            "{input}\n{label}",
            $layout->mergeInputTemplate("{input}\n{label}", true),
            'Local template must override the themed template.',
        );
        self::assertSame(
            'Local label',
            $layout->mergeLabel('Local label'),
            'Local text must override the themed text.',
        );
        self::assertSame(
            ['class' => 'local-label'],
            $layout->mergeLabelAttributes(['class' => 'local-label']),
            'Local class must replace the themed class for the same key.',
        );
        self::assertFalse(
            $layout->mergeNotLabel(false),
            'Local `false` must re-enable the label.',
        );
    }

    public function testMergeReturnsLocalStateFromAnEmptyCarrier(): void
    {
        $layout = new ControlLayout();

        self::assertNull(
            $layout->mergeEnclosedByLabel(null),
            'Empty carrier must keep the unset local flag.',
        );
        self::assertNull(
            $layout->mergeInputContainerTag(null),
            'Empty carrier must keep the unset local tag.',
        );
        self::assertSame(
            "{input}\n{label}",
            $layout->mergeInputTemplate("{input}\n{label}", false),
            'Empty carrier must keep the derived local template.',
        );
        self::assertSame(
            '',
            $layout->mergeLabel(''),
            'Empty carrier must keep the empty local label.',
        );
        self::assertNull(
            $layout->mergeNotLabel(null),
            'Empty carrier must keep the unset local flag.',
        );
    }

    public function testResolvesOnlyTheGenericLabelSlotForAnExplicitInput(): void
    {
        $layout = ControlLayout::resolve(
            new Config(self::layoutTheme()),
            new ComponentContext('field'),
            null,
        );

        self::assertSame(
            ['class' => 'generic-label'],
            $layout->mergeLabelAttributes([]),
            'Only the generic label recipe must be applied.',
        );
        self::assertSame(
            [],
            $layout->mergeInputContainerAttributes([]),
            'Control-specific recipes must be skipped.',
        );
        self::assertNull(
            $layout->mergeInputContainerTag(null),
            'Control-specific recipes must be skipped.',
        );
    }

    public function testResolvesThemedLayoutSlotsForTheFinalControlType(): void
    {
        $layout = ControlLayout::resolve(
            new Config(self::layoutTheme()),
            new ComponentContext('field'),
            'checkbox',
        );

        self::assertSame(
            ['class' => 'checkbox-container'],
            $layout->mergeInputContainerAttributes([]),
            'Control-specific container recipe must be applied.',
        );
        self::assertSame(
            Block::DIV,
            $layout->mergeInputContainerTag(null),
            'Control-specific tag recipe must be applied.',
        );
        self::assertSame(
            ['class' => 'checkbox-label'],
            $layout->mergeLabelAttributes([]),
            'Control-specific label recipe must override the generic class.',
        );
    }

    private static function layoutTheme(): ThemeInterface
    {
        return new class implements ThemeInterface {
            public function getName(): string
            {
                return 'layout';
            }

            public function getRecipes(ComponentContext $context): iterable
            {
                $calls = match ($context->component) {
                    'field.label' => [new Call('labelClass', 'generic-label')],
                    'field.input-container.checkbox' => [
                        new Call('inputContainerClass', 'checkbox-container'),
                        new Call('inputContainerTag', Block::DIV),
                    ],
                    'field.label.checkbox' => [new Call('labelClass', 'checkbox-label', true)],
                    default => [],
                };

                if ($calls !== []) {
                    yield new Recipe("layout.{$context->component}", new Cookbook(...$calls));
                }
            }
        };
    }
}
