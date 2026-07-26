<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Url;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Form\InputUrl;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see InputUrl}.
 */
#[Group('url')]
final class ErrorTest extends TestCase
{
    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->input(InputUrl::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->errorAttributes(['class' => 'value'])
                ->input(InputUrl::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->errorClass('value')
                ->input(InputUrl::tag())
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('url')
                ->errorContent('Error')
                ->input(InputUrl::tag())
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->errorTag(Block::DIV)
                ->input(InputUrl::tag())
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->errorTag(false)
                ->input(InputUrl::tag())
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->errorTag(Inline::SPAN)
                ->input(InputUrl::tag())
                ->render(),
            'Error must render as the given tag.',
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('url', 'Error - 1');
        $formModel->addError('url', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-url">Url</label>
            <input id="basicform-url" name="BasicForm[url]" type="url">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('url')
                ->input(InputUrl::tag())
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }
}
