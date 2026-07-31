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
use UIAwesome\Html\Core\Exception\{ConfigException, Message as ConfigMessage};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Field\ControlLayout;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, EmptyLabelForm};
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for {@see Field} precedence between themed layout recipes and field-local fluent state.
 */
#[Group('config')]
final class FieldLayoutPrecedenceTest extends TestCase
{
    public function testAppliesThemedEnclosedByLabelToTheFinalControl(): void
    {
        $config = new Config(
            self::layoutTheme(
                [
                    'field.label.checkbox' => [new Call('enclosedByLabel', true)],
                ],
            ),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-agree">
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            Agree
            </label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config($config)
                ->control('checkbox')
                ->render(),
            'Themed recipe must enclose the control in its label.',
        );
    }

    public function testAppliesThemedInputTemplateOverTheDerivedCheckboxTemplate(): void
    {
        $config = new Config(
            self::layoutTheme(
                [
                    'field.label.checkbox' => [new Call('inputTemplate', "{label}\n{input}")],
                ],
            ),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-agree">Agree</label>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config($config)
                ->control('checkbox')
                ->render(),
            'Themed template must replace the derived checkbox template.',
        );
    }

    public function testAppliesThemedLabelTextWhenTheModelLabelIsEmpty(): void
    {
        $config = new Config(
            self::layoutTheme(
                ['field.label.text' => [new Call('label', 'Themed label')]],
            ),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="emptylabelform-email">Themed label</label>
            <input id="emptylabelform-email" name="EmptyLabelForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->formModel(new EmptyLabelForm())
                ->property('email')
                ->config($config)
                ->render(),
            'Themed text must fill the empty model label.',
        );
    }

    public function testDoesNotRetainThemedLayoutOnTheFieldAfterRendering(): void
    {
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('agree')
            ->config(new Config(self::checkboxLayoutTheme()))
            ->control('checkbox');

        $field->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="text-container">
            <label class="text-label" for="basicform-agree">Agree</label>
            <input class="text-input" id="basicform-agree" name="BasicForm[agree]" type="text">
            </div>
            </div>
            HTML,
            $field->control('text')->render(),
            'Rendering must not leak themed layout into field-local state.',
        );
    }

    public function testKeepsTheOriginalInstanceUntouchedWhenThemeYieldsNoFieldRecipes(): void
    {
        $original = Field::tag()
            ->formModel(new BasicForm())
            ->property('email');

        $configured = $original->config(
            new Config(
                self::layoutTheme(
                    ['field.label' => [new Call('labelClass', 'generic-label')]],
                ),
            ),
        );

        self::assertNotSame(
            $original,
            $configured,
            'A new instance must be returned.',
        );
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            $original->render(),
            'Original instance must stay unthemed.',
        );
    }

    public function testMergesThemedLayoutAttributesUnderLocalAttributesPerKey(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="checkbox-container" data-role="control">
            <input class="checkbox-input" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label class="checkbox-label" for="basicform-agree" data-label="local">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config(new Config(self::checkboxLayoutTheme()))
                ->control('checkbox')
                ->inputContainerAttributes(['data-role' => 'control'])
                ->labelAttributes(['data-label' => 'local'])
                ->render(),
            'Themed values must fill only attribute keys the field does not set.',
        );
    }

    public function testPrefersLocalEnclosedByLabelOverThemedValue(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label.checkbox' => [new Call('enclosedByLabel', true)]]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config($config)
                ->control('checkbox')
                ->enclosedByLabel(false)
                ->render(),
            'Local `false` must override the themed enclosure.',
        );
    }

    public function testPrefersLocalInputTemplateOverThemedInputTemplate(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label.checkbox' => [new Call('inputTemplate', "{label}\n{input}")]]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label for="basicform-agree">Agree</label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config($config)
                ->control('checkbox')
                ->inputTemplate("{input}\n{label}")
                ->render(),
            'Local template must override the themed template.',
        );
    }

    public function testPrefersLocalNotLabelOverThemedSuppression(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label.text' => [new Call('notLabel')]]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->config($config)
                ->notLabel(false)
                ->render(),
            'Local `false` must re-enable the theme-suppressed label.',
        );
    }

    public function testPrefersTheModelLabelOverThemedLabelText(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label.text' => [new Call('label', 'Themed label')]]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->config($config)
                ->render(),
            'Model label text must win over the themed text.',
        );
    }

    public function testPreservesFluentLayoutOverridesAppliedAfterConfig(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="local-label" for="basicform-agree">Agree</label>
            <input class="checkbox-input" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config(new Config(self::checkboxLayoutTheme()))
                ->control('checkbox')
                ->inputContainerTag(false)
                ->labelClass('local-label', true)
                ->inputTemplate("{label}\n{input}")
                ->render(),
            'Fluent calls after config must override the themed layout recipes.',
        );
    }

    public function testPreservesFluentLayoutOverridesAppliedBeforeConfig(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article class="checkbox-container">
            <input class="checkbox-input" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label class="local-label" for="basicform-agree">Agree</label>
            </article>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->inputContainerTag(Block::ARTICLE)
                ->labelClass('local-label', true)
                ->config(new Config(self::checkboxLayoutTheme()))
                ->control('checkbox')
                ->render(),
            'Fluent calls before config must override the themed layout recipes.',
        );
    }

    public function testRendersIdenticalMarkupOnRepeatedRenders(): void
    {
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('agree')
            ->config(new Config(self::checkboxLayoutTheme()))
            ->control('checkbox');

        self::assertSame(
            $field->render(),
            $field->render(),
            'Repeated renders must not accumulate themed layout state.',
        );
    }

    public function testReplacesThemedClassWithLocalClassForTheSameAttributeKey(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="local-container">
            <input class="checkbox-input" id="basicform-agree" name="BasicForm[agree]" type="checkbox">
            <label class="checkbox-label" for="basicform-agree">Agree</label>
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('agree')
                ->config(new Config(self::checkboxLayoutTheme()))
                ->control('checkbox')
                ->inputContainerClass('local-container')
                ->render(),
            'Local class must replace the themed class for the same key.',
        );
    }

    public function testSkipsNonLayoutRecipeCallsWhenStrictModeIsDisabled(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label' => [new Call('containerClass', 'field-container')]]),
            strict: false,
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-email">Email</label>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->config($config)
                ->render(),
            'Non-strict mode must skip calls the layout carrier does not expose.',
        );
    }

    public function testSuppressesTheLabelWhenAThemedRecipeDisablesIt(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label.text' => [new Call('notLabel')]]),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-email" name="BasicForm[email]" type="text">
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('email')
                ->config($config)
                ->render(),
            'Themed recipe must disable label rendering.',
        );
    }

    public function testThrowConfigExceptionWhenALayoutRecipeNamesANonLayoutMethod(): void
    {
        $config = new Config(
            self::layoutTheme(['field.label' => [new Call('containerClass', 'field-container')]]),
        );

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'containerClass',
                'layout.field.label',
                'field.label',
                ControlLayout::class,
            ),
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('email')
            ->config($config)
            ->render();
    }

    public function testThrowConfigExceptionWhenTheLayoutApplierReturnsAnIncompatibleComponent(): void
    {
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

        $config = new Config(
            self::layoutTheme(
                [
                    'field.label' => [new Call('labelClass', 'generic-label')],
                ],
            ),
            $applier,
        );

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_RETURNED_INCOMPATIBLE_COMPONENT->getMessage(
                'field.label',
                ControlLayout::class,
                RenderableInterface::class . '@anonymous',
            ),
        );

        Field::tag()
            ->formModel(new BasicForm())
            ->property('email')
            ->config($config)
            ->render();
    }

    private static function checkboxLayoutTheme(): ThemeInterface
    {
        return self::layoutTheme(
            [
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
            ],
        );
    }

    /**
     * @param array<string, list<Call>> $recipes Config calls indexed by slot component identifier.
     */
    private static function layoutTheme(array $recipes): ThemeInterface
    {
        return new class ($recipes) implements ThemeInterface {
            /**
             * @param array<string, list<Call>> $recipes Config calls indexed by slot component identifier.
             */
            public function __construct(private readonly array $recipes) {}

            public function getName(): string
            {
                return 'layout';
            }

            public function getRecipes(ComponentContext $context): iterable
            {
                $calls = $this->recipes[$context->component] ?? [];

                if ($calls !== []) {
                    yield new Recipe("layout.{$context->component}", new Cookbook(...$calls));
                }
            }
        };
    }
}
