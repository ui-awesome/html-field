<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Text;

use Dom\{Attr, Element, HTMLCollection, HTMLDocument, NamedNodeMap, NodeList};
use DOMDocument;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, RequiresPhp};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\ErrorProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for {@see Field} error rendering with {@see \UIAwesome\Html\Form\InputText}.
 */
#[Group('text')]
final class ErrorTest extends TestCase
{
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

    #[DataProviderExternal(ErrorProvider::class, 'text')]
    public function testFallbackRemainsText(string $payload): void
    {
        foreach ([null, Inline::SPAN, false] as $tag) {
            $field = Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->template('<div id="boundary"><div id="errors">{error}</div><p>after</p></div>')
                ->errorContent($payload);

            if ($tag !== null) {
                $field = $field->errorTag($tag);
            }

            self::assertErrorText(
                $field->render(),
                $tag === null ? "\n$payload\n" : $payload,
                $tag === null ? 'div' : ($tag === false ? null : 'span'),
            );
        }
    }

    #[DataProviderExternal(ErrorProvider::class, 'text')]
    public function testModelErrorsRemainText(string $payload): void
    {
        $formModel = new BasicForm();

        $formModel->addError('username', $payload);
        $formModel->addError('username', 'Second &amp; <b>inert</b>');
        $formModel->addError('username', 'Last "quoted" error');

        foreach ([null, Inline::SPAN, false] as $tag) {
            foreach ([false, true] as $all) {
                foreach (['', 'Fallback &amp; <b>inert</b>'] as $fallback) {
                    $field = Field::tag()
                        ->formModel($formModel)
                        ->property('username')
                        ->containerTag(false)
                        ->template('<div id="boundary"><div id="errors">{error}</div><p>after</p></div>')
                        ->errorContent($fallback);

                    if ($tag !== null) {
                        $field = $field->errorTag($tag);
                    }

                    if ($all) {
                        $field = $field->showAllErrors();
                    }

                    $rendered = $field->render();

                    if ($all) {
                        self::assertStringContainsString(
                            PHP_EOL . 'Second &amp;amp; &lt;b&gt;inert&lt;/b&gt;' . PHP_EOL . 'Last "quoted" error',
                            $rendered,
                            'Serialized model errors must retain PHP_EOL separators and order.',
                        );
                    }

                    // DOM parsers normalize the serialized presentation separators to LF.
                    $text = $all ? $payload . "\n" . 'Second &amp; <b>inert</b>' . "\n" . 'Last "quoted" error' : $payload;

                    self::assertErrorText(
                        $rendered,
                        $tag === null ? "\n$text\n" : $text,
                        $tag === null ? 'div' : ($tag === false ? null : 'span'),
                    );
                }
            }
        }
    }

    public function testNoErrorOrFallbackOmitsErrorTag(): void
    {
        self::assertErrorText(
            Field::tag()
                ->formModel(new BasicForm())
                ->property('username')
                ->containerTag(false)
                ->template('<div id="boundary"><div id="errors">{error}</div><p>after</p></div>')
                ->render(),
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

    #[RequiresPhp('>=8.4')]
    private static function assertErrorHtml5(string $rendered, string $expected, string|null $tag): void
    {
        self::assertTrue(
            class_exists(HTMLDocument::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );
        self::assertTrue(
            class_exists(HTMLCollection::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );
        self::assertTrue(
            class_exists(Element::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );
        self::assertTrue(
            class_exists(NamedNodeMap::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );
        self::assertTrue(
            class_exists(Attr::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );
        self::assertTrue(
            class_exists(NodeList::class),
            'Native HTML5 parsing is required on PHP 8.4 and later.',
        );

        $document = HTMLDocument::createFromString(
            '<!DOCTYPE html><html><head><title>Control</title></head><body>' . $rendered . '</body></html>',
        );

        self::assertInstanceOf(
            HTMLDocument::class,
            $document,
            'Document must be an instance of HTMLDocument.',
        );

        $bodies = $document->getElementsByTagName('body');

        self::assertInstanceOf(
            HTMLCollection::class,
            $bodies,
            'Body must be an instance of HTMLCollection.',
        );

        $body = $bodies->item(0);

        self::assertInstanceOf(
            Element::class,
            $body,
            'Body must be an instance of Element.',
        );

        $bodyChildren = $body->childNodes;

        self::assertInstanceOf(
            NodeList::class,
            $bodyChildren,
            'Body children must be an instance of NodeList.',
        );
        self::assertSame(
            1,
            $bodyChildren->length,
            'Payload must not escape the field boundary.',
        );

        $divs = $document->getElementsByTagName('div');

        self::assertInstanceOf(
            HTMLCollection::class,
            $divs,
            'Divs must be an instance of HTMLCollection.',
        );
        self::assertSame(
            $tag === 'div' ? 3 : 2,
            $divs->length,
            'Divs must have the correct number of elements.',
        );

        $boundary = $divs->item(0);

        self::assertInstanceOf(
            Element::class,
            $boundary,
            'Boundary must be an instance of Element.',
        );
        self::assertSame(
            $boundary,
            $bodyChildren->item(0),
            'Boundary must be the first child of the body.',
        );

        $boundaryChildren = $boundary->childNodes;

        self::assertInstanceOf(
            NodeList::class,
            $boundaryChildren,
            'Boundary children must be an instance of NodeList.',
        );
        self::assertSame(
            2,
            $boundaryChildren->length,
            'Payload must not create siblings.',
        );

        $errors = $divs->item(1);

        self::assertInstanceOf(
            Element::class,
            $errors,
            'Errors must be an instance of Element.',
        );
        self::assertSame(
            $errors,
            $boundaryChildren->item(0),
            'Errors must be the first child of the boundary.',
        );
        self::assertSame(
            $expected,
            $errors->textContent,
            'HTML5 error text and separators must survive exactly once.',
        );

        $descendants = $errors->getElementsByTagName('*');

        self::assertInstanceOf(
            HTMLCollection::class,
            $descendants,
            'Descendants must be an instance of HTMLCollection.',
        );
        self::assertSame(
            $tag === null ? 0 : 1,
            $descendants->length,
            'Descendants must have the correct number of elements.',
        );

        if ($tag !== null) {
            $errorTag = $descendants->item(0);

            self::assertInstanceOf(
                Element::class,
                $errorTag,
                'Error tag must be an instance of Element.',
            );
            self::assertSame(
                $tag,
                $errorTag->localName,
                'Error tag must have the correct local name.',
            );
        }

        $after = $boundaryChildren->item(1);

        self::assertInstanceOf(
            Element::class,
            $after,
            'After element must be an instance of Element.',
        );
        self::assertSame(
            'p',
            $after->localName,
            'After element must have the correct local name.',
        );
        self::assertSame(
            'after',
            $after->textContent,
            'After element must have the correct text content.',
        );

        $elements = $document->getElementsByTagName('*');

        self::assertInstanceOf(
            HTMLCollection::class,
            $elements,
            'Elements must be an instance of HTMLCollection.',
        );

        foreach ($elements as $element) {
            self::assertInstanceOf(
                Element::class,
                $element,
                'Each element must be an instance of Element.',
            );
            self::assertSame(
                'http://www.w3.org/1999/xhtml',
                $element->namespaceURI,
                'Element must have the correct namespace URI.',
            );
            self::assertContains(
                $element->localName,
                ['html', 'head', 'title', 'body', 'div', 'span', 'p'],
                'Element must have an allowed local name.',
            );

            $attributes = $element->attributes;

            self::assertInstanceOf(
                NamedNodeMap::class,
                $attributes,
                'Attributes must be an instance of NamedNodeMap.',
            );

            foreach ($attributes as $attribute) {
                self::assertInstanceOf(
                    Attr::class,
                    $attribute,
                    'Each attribute must be an instance of Attr.',
                );
                self::assertSame(
                    'id',
                    $attribute->nodeName,
                    'Payload must not create attributes.',
                );
            }
        }
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

        self::assertErrorHtml5(
            $rendered,
            $expected,
            $tag,
        );
    }
}
