<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use DOMDocument;
use DOMElement;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\LabelEnclosureProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, ConfigForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem, InputText, RadioList};
use function substr_count;

/**
 * Unit tests for label enclosure, control preservation, escaping, and immutable rendering.
 */
#[Group('field')]
final class LabelEnclosureTest extends TestCase
{
    #[DataProviderExternal(LabelEnclosureProvider::class, 'choiceLists')]
    public function testChoiceListsRemainStandaloneControls(
        string $type,
        bool $enclosed,
        string $labelState,
        string $expected,
    ): void {
        $input = $type === 'checkbox-list' ? CheckboxList::tag() : RadioList::tag();

        $input = $input->items(
            ChoiceItem::tag()
                ->label('A & B')
                ->value(1),
            ChoiceItem::tag()
                ->label('Second')
                ->value(2),
        );

        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('label')
            ->input($input)
            ->label($labelState === 'empty' ? '' : 'Choices & <all>')
            ->notLabel($labelState === 'disabled')
            ->enclosedByLabel($enclosed);

        $html = $field->render();

        Assert::equalsWithoutLE(
            $expected,
            $html,
            'Each list and its item labels must remain in their original order.',
        );
        self::assertSame(
            2,
            substr_count($html, '<input '),
            'Each choice must render exactly once.',
        );
        self::assertSame(
            $html,
            $field->render(),
            'Repeated renders must not accumulate item enclosure.',
        );
        self::assertSame(
            [],
            $input->getAttributes(),
            'Rendering must not configure the supplied list.',
        );
    }

    #[TestWith(['checkbox'])]
    #[TestWith(['radio'])]
    public function testEnclosedCheckedLabelTextRemainsEscaped(string $type): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="{$type}">
            A &amp; B &lt;b&gt;"quoted" 'single'&lt;/b&gt; &amp;amp;
            </label>
            </div>
            HTML,
            Field::tag()
                ->formModel(new BasicForm())
                ->property('label')
                ->control($type)
                ->label(<<<'TEXT'
                    A & B <b>"quoted" 'single'</b> &amp;
                    TEXT)
                ->enclosedByLabel()
                ->render(),
            'Checkable enclosure must retain its original input-first order and encode label text once.',
        );
    }

    #[TestWith(['text', '<input id="basicform-label" name="BasicForm[label]" type="text">'])]
    #[TestWith(['textarea', '<textarea id="basicform-label" name="BasicForm[label]">' . "\n" . '</textarea>'])]
    public function testEnclosedTextIsEscapedWithoutLosingLiteralEntities(string $type, string $control): void
    {
        $text = <<<'TEXT'
        A & B <b>"quoted" 'single'</b> &amp;
        TEXT;

        $expected = <<<HTML
        <div>
        <label for="basicform-label">A &amp; B &lt;b&gt;"quoted" 'single'&lt;/b&gt; &amp;amp;{$control}</label>
        </div>
        HTML;

        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('label')
            ->control($type)
            ->label($text)
            ->enclosedByLabel()
            ->render();

        Assert::equalsWithoutLE(
            $expected,
            $html,
            'Enclosed label text must be encoded once before the control.',
        );

        $document = new DOMDocument();

        self::assertTrue(
            $document->loadHTML("<!DOCTYPE html><html><body>{$html}</body></html>"),
            'The complete field must parse as HTML.',
        );
        self::assertSame(
            0,
            $document->getElementsByTagName('b')->length,
            'Label text must not create markup.',
        );

        $label = $document->getElementsByTagName('label')->item(0);

        self::assertInstanceOf(
            DOMElement::class,
            $label,
            'The descriptive label must be present.',
        );
        self::assertSame(
            $text . ($type === 'textarea' ? "\n" : ''),
            $label->textContent,
            'Parsed label text must retain literal entities and both quote characters.',
        );
    }

    public function testFinalConfiguredIdRemainsLinkedAcrossClonesAndRepeatedRenders(): void
    {
        $input = InputText::tag()->id('supplied-id');

        $model = new ConfigForm();

        $field = Field::tag()
            ->formModel($model)
            ->property('overrideId')
            ->input($input)
            ->id('field-id');

        $enclosed = $field->enclosedByLabel();

        $copy = clone $enclosed;

        $expected = <<<HTML
        <div>
        <label for="custom-id">Override Id<input id="custom-id" name="ConfigForm[overrideId]" type="text"></label>
        </div>
        HTML;

        self::assertNotSame(
            $field,
            $enclosed,
            'Enclosure must return a new field.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $enclosed->render(),
            'The label must follow the final model-configured ID.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $enclosed->render(),
            'Rendering must not consume the enclosed control.',
        );
        Assert::equalsWithoutLE(
            $expected,
            $copy->render(),
            'A native clone must retain enclosure and final ID binding.',
        );
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="custom-id">Override Id</label>
            <input id="custom-id" name="ConfigForm[overrideId]" type="text">
            </div>
            HTML,
            $field->render(),
            'The source field must retain its separate label and input.',
        );
        self::assertSame(
            'supplied-id',
            $input->getAttribute('id'),
            'The supplied input ID must remain unchanged.',
        );
        self::assertSame(
            '',
            $model->overrideId,
            'Rendering must not write to the model.',
        );
    }

    #[DataProviderExternal(LabelEnclosureProvider::class, 'singleControls')]
    public function testSingleControlRendersOnceWithOptionalLabel(
        string $type,
        bool $enclosed,
        string $labelState,
        string $expected,
    ): void {
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('label')
            ->control($type)
            ->enclosedByLabel($enclosed)
            ->notLabel($labelState === 'disabled');

        if ($labelState === 'empty') {
            $field = $field->label('');
        }

        $html = $field->render();

        Assert::equalsWithoutLE(
            $expected,
            $html,
            'Label omission must never remove or duplicate the control.',
        );
        self::assertSame(
            1,
            substr_count($html, '<input ') + substr_count($html, '<textarea '),
            'Exactly one enabled control must be rendered.',
        );
        self::assertSame(
            $html,
            $field->render(),
            'Repeated rendering must not change label or control state.',
        );
    }
}
