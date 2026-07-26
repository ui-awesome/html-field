<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Factory;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use stdClass;
use UIAwesome\Html\Contracts\Form\FormControlInterface;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;
use UIAwesome\Html\Field\Exception\{ControlNotFound, InvalidControl, Message};
use UIAwesome\Html\Field\Factory\ControlFactory;
use UIAwesome\Html\Field\Tests\Provider\ControlFactoryProvider;
use UIAwesome\Html\Field\Tests\Support\InputWidget;
use UIAwesome\Html\Form\InputEmail;

/**
 * Unit tests for the {@see ControlFactory} creating form controls from semantic component contexts.
 *
 * {@see ControlFactoryProvider} for test case data providers.
 */
#[Group('factory')]
final class ControlFactoryTest extends TestCase
{
    public function testCreatesAConfiguredControlThroughConfig(): void
    {
        $theme = new class implements ThemeInterface {
            public function getName(): string
            {
                return 'test';
            }

            public function getRecipes(ComponentContext $context): iterable
            {
                yield new Recipe('test.control', new Cookbook(new Call('class', $context->component)));
            }
        };

        $config = new Config($theme, factory: new ControlFactory());

        $control = $config->create(new ComponentContext('field.control.email'));

        self::assertInstanceOf(InputEmail::class, $control, 'Registered control must be created.');
        self::assertSame('field.control.email', $control->getAttribute('class'), 'Theme recipe must be applied.');
    }

    public function testCreatesAControlWithAContextAwareClosure(): void
    {
        $receivedContext = null;
        $definition = static function (ComponentContext $context) use (&$receivedContext): FormControlInterface {
            $receivedContext = $context;

            return InputWidget::tag()->addAttribute('data-component', $context->component);
        };

        $controlFactory = new ControlFactory(['custom' => $definition]);
        $context = new ComponentContext('field.control.custom');

        $control = $controlFactory->create($context);

        self::assertSame($context, $receivedContext, 'Context must be forwarded to the closure.');
        self::assertSame(
            'field.control.custom',
            $control->getAttribute('data-component'),
            'Closure control must be returned.',
        );
    }

    /**
     * @param class-string<FormControlInterface> $expected
     */
    #[DataProviderExternal(ControlFactoryProvider::class, 'defaultControls')]
    public function testCreatesDefaultControls(string $type, string $expected): void
    {
        $controlFactory = new ControlFactory();

        $control = $controlFactory->create(new ComponentContext("field.control.{$type}"));

        self::assertInstanceOf($expected, $control, 'Default registry must map the type to its control.');
    }

    public function testCreatesDefaultControlsWithTheirClassDefaults(): void
    {
        $control = (new ControlFactory())->create(new ComponentContext('field.control.email'));

        self::assertSame(
            '<input type="email">',
            $control->render(),
            'Class-level control defaults must be preserved.',
        );
    }

    public function testOverridesADefaultControlThroughTheConstructor(): void
    {
        $controlFactory = new ControlFactory(['email' => InputWidget::class]);

        self::assertInstanceOf(
            InputWidget::class,
            $controlFactory->create(new ComponentContext('field.control.email')),
            'Constructor definitions must take precedence over defaults.',
        );
    }

    public function testReplacesAControlWithAClassWithoutMutatingTheOriginalFactory(): void
    {
        $factory = new ControlFactory(['editor' => InputWidget::class]);
        $configured = $factory->with('email', InputWidget::class);

        self::assertInstanceOf(
            InputEmail::class,
            $factory->create(new ComponentContext('field.control.email')),
            'Original factory must keep the default control.',
        );
        self::assertInstanceOf(
            InputWidget::class,
            $configured->create(new ComponentContext('field.control.email')),
            'Derived factory must use the replacement.',
        );
        self::assertInstanceOf(
            InputWidget::class,
            $configured->create(new ComponentContext('field.control.editor')),
            'Derived factory must keep prior registrations.',
        );
    }

    #[DataProviderExternal(ControlFactoryProvider::class, 'invalidComponents')]
    public function testThrowControlNotFoundForInvalidOrUnknownComponent(string $component): void
    {
        $controlFactory = new ControlFactory();

        $this->expectException(ControlNotFound::class);
        $this->expectExceptionMessage(
            Message::CONTROL_NOT_FOUND->getMessage($component),
        );

        $controlFactory->create(new ComponentContext($component));
    }

    /**
     * @param array<array-key, mixed> $definitions
     */
    #[DataProviderExternal(ControlFactoryProvider::class, 'invalidDefinitions')]
    public function testThrowInvalidArgumentExceptionForInvalidDefinition(array $definitions): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::CONTROL_DEFINITION_INVALID->getMessage('custom'),
        );

        new ControlFactory($definitions);
    }

    #[DataProviderExternal(ControlFactoryProvider::class, 'invalidTypes')]
    public function testThrowInvalidArgumentExceptionForInvalidType(string $type): void
    {
        $controlFactory = new ControlFactory();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::CONTROL_TYPE_INVALID->getMessage(),
        );

        $controlFactory->with($type, InputWidget::class);
    }

    public function testThrowInvalidArgumentExceptionForNumericDefinitionKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::CONTROL_TYPE_INVALID->getMessage(),
        );

        new ControlFactory([InputWidget::class]);
    }

    public function testThrowInvalidControlWhenClosureDoesNotReturnFormControl(): void
    {
        $factory = new ControlFactory(['custom' => static fn(ComponentContext $context): stdClass => new stdClass()]);

        $this->expectException(InvalidControl::class);
        $this->expectExceptionMessage(
            Message::INVALID_CONTROL_RETURNED->getMessage('field.control.custom', 'stdClass'),
        );

        $factory->create(new ComponentContext('field.control.custom'));
    }
}
