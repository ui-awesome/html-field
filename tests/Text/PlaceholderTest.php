<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use UIAwesome\Html\{Field\Field, Field\Tests\Support\BasicForm};
use UIAwesome\Html\Field\Tests\Support\Assert;

final class PlaceholderTest extends \PHPUnit\Framework\TestCase
{
    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-placeholder">Placeholder</label>
            <input id="basicform-placeholder" name="BasicForm[placeholder]" type="text" placeholder="This is a placeholder.">
            </div>
            HTML,
            Field::tag()->formModel(new BasicForm())->property('placeholder')->render()
        );
    }
}
