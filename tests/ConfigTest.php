<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, ConfigForm};
use UIAwesome\Html\Form\InputText;

/**
 * Unit tests for {@see Field} configuration through the form model field config.
 */
#[Group('config')]
final class ConfigTest extends TestCase
{
    public function testAppliesFormModelConfigurationToAnInputSetAfterTheProperty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <input class="custom-class form-control" id="configform-name" name="ConfigForm[name]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag()->formModel(new ConfigForm())->property('name')->input(InputText::tag())->render(),
            "'class' and 'maxlength' must be serialized.",
        );
    }

    public function testAppliesFormModelConfigurationToAReplacedInput(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <input class="custom-class form-control" id="configform-name" name="ConfigForm[name]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag()->input(InputText::tag())->formModel(new ConfigForm())->property('name')->render(),
            "'class' and 'maxlength' must be serialized.",
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <input class="custom-class form-control" id="configform-name" name="ConfigForm[name]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag()->formModel(new ConfigForm())->property('name')->render(),
            "'class' and 'maxlength' must be serialized.",
        );
    }

    public function testRenderWithDefinitions(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="custom-id">Name</label>
            <input class="custom-class form-control" id="custom-id" name="ConfigForm[name]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag(['formModel' => new ConfigForm(), 'property' => 'name', 'id' => 'custom-id'])->render(),
            "'id' definition must propagate to label 'for' and input.",
        );
    }

    public function testReplacesInputBeforeFormModelIsConfigured(): void
    {
        $field = Field::tag()->property('name')->input(InputText::tag());

        self::assertSame(
            '',
            $field->render(),
            'Output must be empty without a form model.',
        );
    }
}
