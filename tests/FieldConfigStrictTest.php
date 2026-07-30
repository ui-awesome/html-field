<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\FormModel\Attribute\FieldConfig;
use UIAwesome\FormModel\BaseFormModel;
use UIAwesome\Html\Core\Config\{ComponentContext, Config};
use UIAwesome\Html\Core\Exception\{ConfigException, Message as ConfigMessage};
use UIAwesome\Html\Field\Exception\InvalidFieldConfig;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\FieldConfigProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, ConfigForm, InvalidConfigForm, RecordingTheme};
use UIAwesome\Html\Form\{InputText, Select};

/**
 * Unit tests for {@see Field} applying the form model field config through the core config applier in strict mode.
 *
 * {@see FieldConfigProvider} for test case data providers.
 */
#[Group('config')]
final class FieldConfigStrictTest extends TestCase
{
    public function testAppliesBareScalarAndPositionalListEntriesToTheSelectedControl(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <textarea class="custom-class form-control" id="configform-name" name="ConfigForm[name]" maxlength="10">
            </textarea>
            </div>
            HTML,
            Field::tag()
                ->formModel(new ConfigForm())
                ->property('name')
                ->control('textarea')
                ->render(),
            'Both entry shapes must reach a control other than the default one.',
        );
    }

    public function testAppliesCanonicalAttributeConfigurationFromFormModel(): void
    {
        $formModel = new class extends BaseFormModel {
            #[FieldConfig(['class' => ['canonical-class']])]
            public string $email = '';
        };

        self::assertStringContainsString(
            '<input class="canonical-class"',
            Field::tag()
                ->formModel($formModel)
                ->property('email')
                ->control('email')
                ->render(),
            'A canonical form-model attribute entry must configure the resolved field control.',
        );
    }

    #[DataProviderExternal(FieldConfigProvider::class, 'bindingOverrides')]
    public function testAppliesEntriesOverridingTheModelBinding(
        string $property,
        string $control,
        string $expected,
    ): void {
        Assert::equalsWithoutLE(
            $expected,
            Field::tag()
                ->formModel(new ConfigForm())
                ->property($property)
                ->control($control)
                ->render(),
            'Config entries must override the derived binding state.',
        );
    }

    public function testAppliesEveryEntryWhenABareScalarPrecedesAPositionalList(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-ordered">Ordered</label>
            <input class="custom-class" id="configform-ordered" name="ConfigForm[ordered]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag()
                ->formModel(new ConfigForm())
                ->property('ordered')
                ->render(),
            'Entries following a bare scalar must still be applied.',
        );
    }

    /**
     * @param callable(ConfigForm): Field $build Fluent chain ordering under test.
     */
    #[DataProviderExternal(FieldConfigProvider::class, 'replacementControlOrders')]
    public function testAppliesReplacementControlEntriesRegardlessOfFluentOrder(callable $build): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-textarea">Text Area</label>
            <textarea class="custom-class" id="configform-textarea" name="ConfigForm[textArea]" rows="5">
            </textarea>
            </div>
            HTML,
            $build(new ConfigForm())->render(),
            'Every fluent order must produce the same markup.',
        );
    }

    public function testOverridesTheFieldFluentValueWithAConfigEntry(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-overridevalue">Override Value</label>
            <input id="configform-overridevalue" name="ConfigForm[overrideValue]" type="text" value="custom-value">
            </div>
            HTML,
            Field::tag()
                ->formModel(new ConfigForm())
                ->property('overrideValue')
                ->value('fluent-value')
                ->render(),
            'Config entries must outrank the field fluent state.',
        );
    }

    public function testReportsTheControlSlotContextInheritedFromTheConfiguredFieldContext(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'maxlenght',
                'field-config.unknownMethod',
                'custom-field.control',
                InputText::class,
            ),
        );

        Field::tag()
            ->input(InputText::tag())
            ->config(new Config(new RecordingTheme()), new ComponentContext('custom-field'))
            ->formModel(new InvalidConfigForm())
            ->property('unknownMethod')
            ->render();
    }

    public function testThrowConfigExceptionWhenFieldConfigNamesAnUnknownControlMethod(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'maxlenght',
                'field-config.unknownMethod',
                'field.control',
                InputText::class,
            ),
        );

        Field::tag()
            ->formModel(new InvalidConfigForm())
            ->property('unknownMethod')
            ->render();
    }

    public function testThrowConfigExceptionWhenTheDefaultControlDoesNotExposeAReplacementOnlyMethod(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'rows',
                'field-config.textArea',
                'field.control',
                InputText::class,
            ),
        );

        Field::tag()
            ->formModel(new ConfigForm())
            ->property('textArea')
            ->render();
    }

    public function testThrowConfigExceptionWhenTheSelectedControlDoesNotExposeAConfiguredMethod(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'maxlength',
                'field-config.name',
                'field.control',
                Select::class,
            ),
        );

        Field::tag()
            ->formModel(new ConfigForm())
            ->property('name')
            ->control('select')
            ->render();
    }

    public function testThrowConfigExceptionWhenTheSuppliedInputDoesNotExposeAConfiguredMethod(): void
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            ConfigMessage::CONFIG_CALL_METHOD_NOT_AVAILABLE->getMessage(
                'maxlength',
                'field-config.name',
                'field.control',
                Select::class,
            ),
        );

        Field::tag()
            ->formModel(new ConfigForm())
            ->property('name')
            ->input(Select::tag())
            ->render();
    }

    #[DataProviderExternal(FieldConfigProvider::class, 'unsupportedShapes')]
    public function testThrowInvalidFieldConfigForUnsupportedShape(string $property, string $message): void
    {
        $this->expectException(InvalidFieldConfig::class);
        $this->expectExceptionMessage($message);

        Field::tag()
            ->formModel(new InvalidConfigForm())
            ->property($property)
            ->render();
    }
}
