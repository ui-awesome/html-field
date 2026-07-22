<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\Assert;
use UIAwesome\Html\Field\Tests\Support\ConfigForm;
use UIAwesome\Html\Form\InputText;

final class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="configform-name">Name</label>
            <input class="custom-class form-control" id="configform-name" name="ConfigForm[name]" type="text" maxlength="10">
            </div>
            HTML,
            Field::tag()->formModel(new ConfigForm())->property('name')->render()
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
            Field::tag(['formModel' => new ConfigForm(), 'property' => 'name', 'id' => 'custom-id'])->render()
        );
    }

    public function testAppliesFormModelConfigurationToAReplacedInput(): void
    {
        $field = Field::tag()->formModel(new ConfigForm())->property('name');

        self::assertStringContainsString(
            'class="custom-class form-control"',
            $field->input(InputText::tag())->render(),
        );
        self::assertStringContainsString('maxlength="10"', $field->input(InputText::tag())->render());
    }

    public function testReplacesInputBeforeFormModelIsConfigured(): void
    {
        $field = Field::tag()->property('name')->input(InputText::tag());

        self::assertSame('', $field->render());
    }
}
