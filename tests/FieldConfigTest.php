<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, FieldTheme, InputWidget, RecordingTheme};

/**
 * Unit tests for {@see Field} application-scoped config and semantic control integration.
 */
#[Group('config')]
final class FieldConfigTest extends TestCase
{
    public function testAppliesGenericControlSlotRecipeToAnExplicitInput(): void
    {
        $theme = new class implements ThemeInterface {
            public function getName(): string
            {
                return 'custom';
            }

            public function getRecipes(ComponentContext $context): iterable
            {
                if ($context->component === 'field.control') {
                    yield new Recipe('custom.control', new Cookbook(new Call('class', 'custom-control')));
                }
            }
        };

        $output = Field::tag()
            ->input(InputWidget::tag())
            ->config(new Config($theme))
            ->formModel(new BasicForm())
            ->property('email')
            ->render();

        self::assertStringContainsString(
            '<control class="custom-control"',
            $output,
            'An explicit input set before config must receive the generic control-slot recipe.',
        );
    }

    public function testAppliesInterchangeableThemeRecipesToEveryFieldSlot(): void
    {
        $baseField = Field::tag()
            ->control('email')
            ->formModel(new BasicForm())
            ->property('email')
            ->prefix('@')
            ->suffix('.test')
            ->hintContent('Email hint.')
            ->errorContent('Email error.');

        $flowbite = new Config(
            new FieldTheme(
                'flowbite',
                [
                    'field' => 'flowbite-field',
                    'container' => 'flowbite-container',
                    'label' => 'flowbite-label',
                    'control' => 'flowbite-control',
                    'hint' => 'flowbite-hint',
                    'error' => 'flowbite-error',
                    'prefix' => 'flowbite-prefix',
                    'suffix' => 'flowbite-suffix',
                ],
            ),
            factory: new ControlFactory(),
        );
        $daisyUi = new Config(
            new FieldTheme(
                'daisyui',
                [
                    'field' => 'daisyui-field',
                    'container' => 'daisyui-container',
                    'label' => 'daisyui-label',
                    'control' => 'daisyui-control',
                    'hint' => 'daisyui-hint',
                    'error' => 'daisyui-error',
                    'prefix' => 'daisyui-prefix',
                    'suffix' => 'daisyui-suffix',
                ],
            ),
            factory: new ControlFactory(),
        );

        $flowbiteOutput = $baseField->config($flowbite)->render();
        $daisyUiOutput = $baseField->config($daisyUi)->render();

        foreach (['field', 'container', 'label', 'control', 'hint', 'error', 'prefix', 'suffix'] as $slot) {
            self::assertStringContainsString(
                "flowbite-{$slot}",
                $flowbiteOutput,
                "Flowbite '{$slot}' recipe must be applied.",
            );
            self::assertStringContainsString(
                "daisyui-{$slot}",
                $daisyUiOutput,
                "DaisyUI '{$slot}' recipe must be applied.",
            );
            self::assertStringNotContainsString(
                "daisyui-{$slot}",
                $flowbiteOutput,
                "Flowbite output must not inherit DaisyUI '{$slot}' configuration.",
            );
            self::assertStringNotContainsString(
                "flowbite-{$slot}",
                $daisyUiOutput,
                "DaisyUI output must not inherit Flowbite '{$slot}' configuration.",
            );
        }

        self::assertStringContainsString(
            'type="email"',
            $flowbiteOutput,
            'Factory must create an email control.',
        );
        self::assertStringContainsString(
            'type="email"',
            $daisyUiOutput,
            'Factory must create an email control.',
        );
    }

    public function testPropagatesFieldContextToEverySemanticSlot(): void
    {
        $theme = new RecordingTheme();
        $context = new ComponentContext(
            'field',
            variant: 'floating',
            size: 'small',
            scheme: 'primary',
            states: ['invalid'],
            metadata: ['layout' => 'stacked'],
        );

        Field::tag()->config(new Config($theme), $context);

        self::assertSame(
            [
                'field',
                'field.container',
                'field.label',
                'field.control.text',
                'field.hint',
                'field.error',
                'field.prefix',
                'field.suffix',
            ],
            array_map(
                static fn(ComponentContext $resolvedContext): string => $resolvedContext->component,
                $theme->contexts,
            ),
            'Every semantic field slot must be resolved in order.',
        );

        foreach ($theme->contexts as $resolvedContext) {
            self::assertSame(
                'floating',
                $resolvedContext->variant,
                'Variant must propagate to every slot.',
            );
            self::assertSame(
                'small',
                $resolvedContext->size,
                'Size must propagate to every slot.',
            );
            self::assertSame(
                'primary',
                $resolvedContext->scheme,
                'Scheme must propagate to every slot.',
            );
            self::assertSame(
                ['invalid'],
                $resolvedContext->states,
                'States must propagate to every slot.',
            );
            self::assertSame(
                ['layout' => 'stacked'],
                $resolvedContext->metadata,
                'Metadata must propagate to every slot.',
            );
        }
    }

    public function testSelectsAConfiguredSemanticControlAfterConfigIsApplied(): void
    {
        $config = new Config(
            new FieldTheme(
                'flowbite',
                [
                    'field' => 'field',
                    'container' => 'container',
                    'label' => 'label',
                    'control' => 'control',
                    'hint' => 'hint',
                    'error' => 'error',
                    'prefix' => 'prefix',
                    'suffix' => 'suffix',
                ],
            ),
            factory: new ControlFactory(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="container">
            <div class="field">
            <label class="label" for="basicform-email">Email</label>
            <input class="control" id="basicform-email" name="BasicForm[email]" type="email">
            </div>
            </div>
            HTML,
            Field::tag()
                ->config($config)
                ->control('email')
                ->formModel(new BasicForm())
                ->property('email')
                ->render(),
            'A semantic control selected after config must use the configured factory and recipe.',
        );
    }
}
