<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use DOMDocument;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\ErrorProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see \UIAwesome\Html\Form\InputText}.
 *
 * {@see ErrorProvider} for test case data providers.
 */
#[Group('text')]
final class ErrorTest extends TestCase
{
    #[DataProviderExternal(ErrorProvider::class, 'allErrors')]
    public function testAllModelErrorsKeepSerializedSeparators(
        string $payload,
        Inline|false|null $tag,
        string $fallback,
    ): void {
        self::assertStringContainsString(
            PHP_EOL . 'Second &amp;amp; &lt;b&gt;inert&lt;/b&gt;' . PHP_EOL . 'Last "quoted" error',
            self::renderModelErrors($payload, $tag, true, $fallback),
            'Serialized errors must retain platform separators and order.',
        );
    }

    public function testError(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->errorAttributes(['class' => 'value'])
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div class="value">
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->errorClass('value')
                ->render(),
            "Error 'class' must be serialized.",
        );
    }

    public function testErrorContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->errorContent('Error')
                ->render(),
            'Error content must be rendered.',
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->errorTag(Block::DIV)
                ->render(),
            "Error must render as '<div>'.",
        );
    }

    public function testErrorTagWithFalseValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            Error
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->errorTag(false)
                ->render(),
            'Error tag must be omitted.',
        );
    }

    public function testErrorTagWithValue(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <span>Error</span>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->errorTag(Inline::SPAN)
                ->render(),
            'Error must render as the given tag.',
        );
    }

    #[DataProviderExternal(ErrorProvider::class, 'fallback')]
    public function testFallbackRemainsText(
        string $payload,
        Inline|false|null $tag,
        string $expected,
        string|null $expectedTag,
    ): void {
        $rendered = self::field(new BasicForm(), $tag)->errorContent($payload)->render();

        self::assertErrorText(
            $rendered,
            $expected,
            $expectedTag,
        );
    }

    #[DataProviderExternal(ErrorProvider::class, 'modelErrors')]
    public function testModelErrorsRemainText(
        string $payload,
        Inline|false|null $tag,
        bool $all,
        string $fallback,
        string $expected,
        string|null $expectedTag,
    ): void {
        self::assertErrorText(
            self::renderModelErrors($payload, $tag, $all, $fallback),
            $expected,
            $expectedTag,
        );
    }

    public function testNoErrorOrFallbackOmitsErrorTag(): void
    {
        self::assertErrorText(
            self::field(new BasicForm(), null)->render(),
            '',
            null,
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', 'Error - 1');
        $formModel->addError('username', 'Error - 2');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-username">Username</label>
            <input id="basicform-username" name="BasicForm[username]" type="text">
            <div>
            Error - 1
            Error - 2
            </div>
            </div>
            HTML,
            Field::tag()
                ->formModel($formModel)
                ->property('username')
                ->showAllErrors()
                ->render(),
            'All errors must be rendered.',
        );
    }

    private static function assertErrorText(string $rendered, string $expected, string|null $tag): void
    {
        if ($rendered === '') {
            self::fail(
                'The error fragment must not be empty.',
            );
        }

        $document = new DOMDocument();

        self::assertTrue(
            $document->loadXML($rendered),
            'The error fragment must remain valid XML.',
        );

        $boundary = $document->getElementsByTagName('div')->item(0);

        self::assertNotNull(
            $boundary,
            "Boundary must not be 'null'.",
        );
        self::assertSame(
            2,
            $boundary->childNodes->length,
            'Payload must not create siblings.',
        );

        $errors = $document->getElementsByTagName('div')->item(1);

        self::assertNotNull(
            $errors,
            "Errors container must not be 'null'.",
        );
        self::assertSame(
            $errors,
            $boundary->firstChild,
            'Error container must stay first.',
        );
        self::assertSame(
            'p',
            $boundary->lastChild?->localName,
            'Trailing element must remain intact.',
        );
        self::assertSame(
            'after',
            $boundary->lastChild->textContent,
            'Trailing text must remain intact.',
        );
        self::assertSame(
            $expected,
            $errors->textContent,
            'Error text and separators must survive exactly once.',
        );
        self::assertSame(
            $tag === null ? 0 : 1,
            $errors->getElementsByTagName('*')->length,
            'Error elements count must match the expected tag presence.',
        );

        if ($tag !== null) {
            self::assertSame(
                $tag,
                $errors->firstChild?->localName,
                'Error element tag must match the expected tag.',
            );
        }

        foreach ($document->getElementsByTagName('*') as $element) {
            self::assertContains(
                $element->localName,
                ['div', 'span', 'p'],
                'Element must be one of the allowed tags.',
            );

            foreach ($element->attributes as $attribute) {
                self::assertSame(
                    'id',
                    $attribute->nodeName,
                    'Payload must not create attributes.',
                );
            }
        }
    }

    private static function field(BasicForm $formModel, Inline|false|null $tag): Field
    {
        $field = Field::tag()
            ->formModel($formModel)
            ->property('username')
            ->containerTag(false)
            ->template('<div id="boundary"><div id="errors">{error}</div><p>after</p></div>');

        return $tag === null ? $field : $field->errorTag($tag);
    }

    private static function renderModelErrors(
        string $payload,
        Inline|false|null $tag,
        bool $all,
        string $fallback,
    ): string {
        $formModel = new BasicForm();

        $formModel->addError('username', $payload);
        $formModel->addError('username', 'Second &amp; <b>inert</b>');
        $formModel->addError('username', 'Last "quoted" error');

        $field = self::field($formModel, $tag)->errorContent($fallback);

        return ($all ? $field->showAllErrors() : $field)->render();
    }
}
