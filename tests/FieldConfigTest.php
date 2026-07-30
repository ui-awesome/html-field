<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Config\{
    Call,
    ComponentContext,
    Config,
    ConfigApplierInterface,
    Cookbook,
    Recipe,
};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Field\Exception\{InvalidControl, Message};
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, FieldTheme, RecordingTheme};
use UIAwesome\Html\Form\{InputHidden, InputText};
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} application-scoped config and semantic control integration.
 */
#[Group('config')]
final class FieldConfigTest extends TestCase
{
    public function testAppliesControlSpecificLayoutSlotsRegardlessOfFluentOrder(): void
    {
        $config = new Config(self::controlLayoutTheme());
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('agree');

        $expected = <<<HTML
            <div>
            <div class="checkbox-container">
            <input class="checkbox-input" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label class="checkbox-label" for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML;

        Assert::equalsWithoutLE(
            $expected,
            $field->config($config)->control('checkbox')->render(),
            'A control selected after config must receive its specific layout slots.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $field->control('checkbox')->config($config)->render(),
            'A control selected before config must receive its specific layout slots.',
        );
    }

    public function testAppliesGenericControlSlotRecipeToAnExplicitInput(): void
    {
        $theme = self::controlSlotTheme('custom', new Cookbook(new Call('class', 'custom-control')));

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input class="custom-control" id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->input(InputText::tag())
                ->config(new Config($theme))
                ->formModel(new BasicForm())
                ->property('email')
                ->render(),
            'An input set before config must receive the generic control-slot recipe.',
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
            new FieldTheme('flowbite', self::slotClasses('flowbite-')),
            factory: new ControlFactory(),
        );
        $daisyUi = new Config(
            new FieldTheme('daisyui', self::slotClasses('daisyui-')),
            factory: new ControlFactory(),
        );

        $flowbiteOutput = $baseField->config($flowbite)->render();
        $daisyUiOutput = $baseField->config($daisyUi)->render();

        foreach (array_keys(self::slotClasses()) as $slot) {
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

    public function testConfiguredFactoryReplacesTheDefaultFieldFactory(): void
    {
        $config = new Config(
            new FieldTheme('custom', self::slotClasses()),
            factory: new ControlFactory(['email' => InputHidden::class]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="container">
            <div class="field">
            <label class="label" for="basicform-email">Email</label>
            <input class="control" id="basicform-email" name="BasicForm[email]" type="hidden">
            </div>
            </div>
            HTML,
            Field::tag()
                ->config($config)
                ->control('email')
                ->formModel(new BasicForm())
                ->property('email')
                ->render(),
            'The default registry must not replace the factory carried by config.',
        );
    }

    public function testPreservesExplicitInputTemplateWhenControlIsReplaced(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-agree">Agree</label>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            </div>
            HTML,
            Field::tag()
                ->inputTemplate("{label}\n{input}")
                ->control('checkbox')
                ->formModel(new BasicForm())
                ->property('agree')
                ->render(),
            'Replacing a control must preserve an explicitly configured input template.',
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

        Field::tag()
            ->config(new Config($theme), $context)
            ->formModel(new BasicForm())
            ->property('email')
            ->render();

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
                'field.input-container.text',
                'field.label.text',
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

    public function testRebuildsControlSpecificLayoutWhenControlIsReplaced(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="text-container">
            <label class="text-label" for="basicform-email">Email</label>
            <input class="text-input" id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->config(new Config(self::controlLayoutTheme()))
                ->control('checkbox')
                ->control('text')
                ->render(),
            'Replacing a control must rebuild its control-specific layout slots.',
        );
    }

    public function testResetsControlSpecificLayoutWhenInputIsReplacedAfterConfig(): void
    {
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('email')
            ->config(new Config(self::controlLayoutTheme()));

        $expected = <<<HTML
            <div>
            <label class="generic-label" for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML;

        Assert::equalsWithoutLE(
            $expected,
            $field->input(InputText::tag())->render(),
            'An explicit input must clear the default text control layout.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $field->control('checkbox')->input(InputText::tag())->render(),
            'An explicit input must clear the previously selected control layout.',
        );
    }

    public function testSelectsAConfiguredSemanticControlAfterConfigIsApplied(): void
    {
        $config = new Config(
            new FieldTheme('flowbite', self::slotClasses()),
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

    public function testThrowInvalidControlForGenericRecipeReturningOnlyRenderable(): void
    {
        $theme = self::controlSlotTheme('invalid', new Cookbook());
        $applier = new class implements ConfigApplierInterface {
            public function apply(
                object $component,
                Recipe $recipe,
                ComponentContext $context,
                bool $strict = true,
            ): object {
                return new class implements RenderableInterface {
                    public function __toString(): string
                    {
                        return $this->render();
                    }

                    public function render(): string
                    {
                        return '';
                    }
                };
            }
        };

        $this->expectException(InvalidControl::class);
        $this->expectExceptionMessage(
            Message::INVALID_CONTROL_RETURNED->getMessage(
                'field.control',
                RenderableInterface::class . '@anonymous',
            ),
        );

        Field::tag()
            ->input(InputText::tag())
            ->config(new Config($theme, $applier));
    }

    private static function controlLayoutTheme(): ThemeInterface
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
                    'field.control.checkbox' => [new Call('class', 'checkbox-input')],
                    'field.control.text' => [new Call('class', 'text-input')],
                    'field.input-container.checkbox' => [
                        new Call('inputContainerClass', 'checkbox-container'),
                        new Call('inputContainerTag', Block::DIV),
                    ],
                    'field.input-container.text' => [
                        new Call('inputContainerClass', 'text-container'),
                        new Call('inputContainerTag', Block::DIV),
                    ],
                    'field.label.checkbox' => [new Call('labelClass', 'checkbox-label', true)],
                    'field.label.text' => [new Call('labelClass', 'text-label', true)],
                    default => [],
                };

                if ($calls !== []) {
                    yield new Recipe("layout.{$context->component}", new Cookbook(...$calls));
                }
            }
        };
    }

    private static function controlSlotTheme(string $name, Cookbook $cookbook): ThemeInterface
    {
        return new class ($name, $cookbook) implements ThemeInterface {
            public function __construct(private readonly string $name, private readonly Cookbook $cookbook) {}

            public function getName(): string
            {
                return $this->name;
            }

            public function getRecipes(ComponentContext $context): iterable
            {
                if ($context->component === 'field.control') {
                    yield new Recipe("{$this->name}.control", $this->cookbook);
                }
            }
        };
    }

    /**
     * @return array{
     *     field: string,
     *     container: string,
     *     label: string,
     *     control: string,
     *     hint: string,
     *     error: string,
     *     prefix: string,
     *     suffix: string,
     * } Slot class names indexed by slot name.
     */
    private static function slotClasses(string $prefix = ''): array
    {
        return [
            'field' => "{$prefix}field",
            'container' => "{$prefix}container",
            'label' => "{$prefix}label",
            'control' => "{$prefix}control",
            'hint' => "{$prefix}hint",
            'error' => "{$prefix}error",
            'prefix' => "{$prefix}prefix",
            'suffix' => "{$prefix}suffix",
        ];
    }
}
