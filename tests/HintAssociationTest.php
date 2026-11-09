<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests;

use DOMDocument;
use DOMElement;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Field\Field;
use UIAwesome\Html\Field\Tests\Provider\HintAssociationProvider;
use UIAwesome\Html\Field\Tests\Support\{Assert, BasicForm, HintConfigForm};
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem, InputCheckbox, InputRadio, InputText, RadioList, TextArea};
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Phrasing\Span;
use UnitEnum;

use function preg_split;

/**
 * Unit tests for emitted hint associations, token merging, precedence, and immutable rendering.
 */
#[Group('field')]
final class HintAssociationTest extends TestCase
{
    #[TestWith(['checkbox'])]
    #[TestWith(['radio'])]
    public function testChoiceListsLinkTheirContainerToTheEmittedHint(string $type): void
    {
        $input = $type === 'checkbox' ? CheckboxList::tag() : RadioList::tag();

        $input = $input
            ->items(
                ChoiceItem::tag()
                    ->label('First')
                    ->value(1),
                )
            ->addAttribute('aria-describedby', 'external-hint');

        $name = $type === 'checkbox' ? 'BasicForm[hint][]' : 'BasicForm[hint]';

        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('hint')
            ->input($input)
            ->notLabel()
            ->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="basicform-hint" aria-describedby="external-hint basicform-hint-help">
            <input id="basicform-hint-0" name="{$name}" type="{$type}" value="1">
            <label for="basicform-hint-0">First</label>
            </div>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            $html,
            'Choice lists must retain external descriptions on their container.',
        );
        self::assertDescriptionTargets(
            $html,
            'basicform-hint-help',
        );
        self::assertSame(
            'external-hint',
            $input->getAttribute('aria-describedby'),
            'The supplied list must not change.',
        );
    }

    public function testClonesAndRepeatedRendersDoNotAccumulateDescriptions(): void
    {
        $model = new BasicForm();

        $input = InputText::tag()->addAttribute('aria-describedby', 'external-hint');
        $field = Field::tag()
            ->formModel($model)
            ->property('hint')
            ->input($input)
            ->enclosedByLabel();

        $inline = $field
            ->hintId('custom-help')
            ->hintTag(Inline::SPAN);

        $copy = clone $inline;

        $expected = <<<HTML
            <div>
            <label for="basicform-hint">Hint<input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="external-hint custom-help"></label>
            <span id="custom-help">This is a hint.</span>
            </div>
            HTML;

        self::assertNotSame(
            $field,
            $inline,
            'Hint setters must return a clone.',
        );

        foreach ([$inline, $copy, $inline] as $renderedField) {
            $html = $renderedField->render();

            Assert::equalsWithoutLE(
                $expected,
                $html,
                'Clones and repeated renders must retain stable hint tokens.',
            );
            self::assertDescriptionTargets(
                $html,
                'custom-help',
            );
        }

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="basicform-hint">Hint<input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="external-hint basicform-hint-help"></label>
            <div id="basicform-hint-help">
            This is a hint.
            </div>
            </div>
            HTML,
            $field->render(),
            'The original field must retain its default block hint and ID.',
        );
        self::assertSame(
            'external-hint',
            $input->getAttribute('aria-describedby'),
            'The supplied input must not change.',
        );
        self::assertNull(
            $model->hint,
            'Rendering must not write hint state to the model.',
        );
    }

    #[TestWith(['field', 'second-hint second-hint'])]
    #[TestWith(['field', ''])]
    #[TestWith(['model', 'second-hint second-hint'])]
    #[TestWith(['model', ''])]
    #[TestWith(['remove', ''])]
    public function testExplicitOverridesRemainFinal(string $source, string $description): void
    {
        $config = match ($source) {
            'model' => ['addAttribute' => ['aria-describedby', $description]],
            'remove' => ['removeAttribute' => ['aria-describedby']],
            default => [],
        };

        $field = Field::tag()
            ->formModel(new HintConfigForm($config))
            ->property('hint')
            ->input(InputText::tag()->addAttribute('aria-describedby', 'external-hint'))
            ->hintContent('Hint')
            ->notLabel()
            ->addAttribute('aria-describedby', $source === 'field' ? $description : 'external-hint');

        $attribute = $description === '' ? '' : " aria-describedby=\"$description\"";

        $html = $field->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="hintconfigform-hint" name="HintConfigForm[hint]" type="text"{$attribute}>
            <div id="hintconfigform-hint-help">
            Hint
            </div>
            </div>
            HTML,
            $html,
            'Explicit field attributes and final model configuration must not receive an automatic append.',
        );
        self::assertDescriptionTargets(
            $html,
            null,
        );
    }

    #[DataProviderExternal(HintAssociationProvider::class, 'rendering')]
    public function testOnlyEmittedHintElementsReceiveAutomaticReferences(
        string $content,
        string $id,
        false|UnitEnum $tag,
        string $template,
        string $hint,
        string|null $automaticId,
    ): void {
        $field = Field::tag()
            ->formModel(new BasicForm())
            ->property('hint')
            ->input(InputText::tag()->addAttribute('aria-describedby', 'external-hint'))
            ->notLabel()
            ->hintContent($content)
            ->hintId($id)
            ->hintTag($tag)
            ->template($template);

        $description = 'external-hint' . ($automaticId === null ? '' : " {$automaticId}");
        $hint = $hint === '' ? '' : "\n{$hint}";

        $html = $field->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="{$description}">{$hint}
            </div>
            HTML,
            $html,
            'Automatic references require emitted content, a usable ID, a container, and the hint slot.',
        );

        if (preg_split('/[\t\n\f\r ]/', $id) === [$id]) {
            self::assertDescriptionTargets(
                $html,
                $automaticId,
            );
        }
    }

    public function testRenderableMarkupAndTextEscapingRemainDistinct(): void
    {
        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('hint')
            ->notLabel()
            ->hintContent('<b>A & B</b> &amp;', Span::tag()->content('Allowed & safe'))
            ->hintId('help&"quoted')
            ->hintAttributes(['id' => 'ignored-id'])
            ->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="help&amp;&quot;quoted">
            <div id="help&amp;&quot;quoted">
            &lt;b&gt;A &amp; B&lt;/b&gt; &amp;amp;<span>Allowed &amp; safe</span>
            </div>
            </div>
            HTML,
            $html,
            'Hint text and IDs must be encoded once while renderable markup remains allowed.',
        );
        self::assertDescriptionTargets(
            $html,
            'help&"quoted',
        );
    }

    #[DataProviderExternal(HintAssociationProvider::class, 'descriptions')]
    public function testSuppliedDescriptionTokensMergeInStableOrder(string|null $existing, string $expected): void
    {
        $html = Field::tag()
            ->formModel(new BasicForm())
            ->property('hint')
            ->input(InputText::tag()->addAttribute('aria-describedby', $existing))
            ->hintId('custom-help')
            ->notLabel()
            ->render();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="basicform-hint" name="BasicForm[hint]" type="text" aria-describedby="{$expected}">
            <div id="custom-help">
            This is a hint.
            </div>
            </div>
            HTML,
            $html,
            'Existing description tokens must retain first-occurrence order without duplicates.',
        );
        self::assertDescriptionTargets(
            $html,
            'custom-help',
        );
    }

    #[DataProviderExternal(HintAssociationProvider::class, 'singleControls')]
    public function testSupportedControlsRetainExternalDescriptions(string $type, string $expected): void
    {
        $input = match ($type) {
            'textarea' => TextArea::tag(),
            'checkbox' => InputCheckbox::tag(),
            'radio' => InputRadio::tag(),
            default => InputText::tag(),
        };

        $html = Field::tag()
            ->input($input->addAttribute('aria-describedby', 'external-hint'))
            ->formModel(new BasicForm())
            ->property('hint')
            ->notLabel()
            ->render();

        Assert::equalsWithoutLE(
            $expected,
            $html,
            'Each supported control must retain the supplied description.',
        );
        self::assertDescriptionTargets(
            $html,
            'basicform-hint-help',
        );
    }

    private static function assertDescriptionTargets(string $html, string|null $automaticId): void
    {
        $document = new DOMDocument();

        self::assertTrue(
            $document->loadHTML(
                '<!DOCTYPE html><html><body><p id="external-hint">External</p>'
                . '<p id="second-hint">Second</p><p id="external&amp;hint">Escaped</p>' . $html . '</body></html>',
            ),
            'The field and legitimate external descriptions must parse as a complete HTML document.',
        );

        foreach ($document->getElementsByTagName('*') as $element) {
            if ($element->hasAttribute('aria-describedby')) {
                $tokens = preg_split(
                    '/[\t\n\f\r ]+/',
                    $element->getAttribute('aria-describedby'),
                    -1,
                    PREG_SPLIT_NO_EMPTY,
                );

                self::assertIsArray(
                    $tokens,
                    'Description tokens must be parseable.',
                );

                foreach ($tokens as $token) {
                    self::assertInstanceOf(
                        DOMElement::class,
                        $document->getElementById($token),
                        'Each description must resolve to an emitted or legitimate external element.',
                    );
                }
            }
        }

        if ($automaticId !== null) {
            $hint = $document->getElementById($automaticId);

            self::assertInstanceOf(
                DOMElement::class,
                $hint,
                'The automatic reference must resolve to the hint element.',
            );
            self::assertNotSame(
                '',
                $hint->textContent,
                'The referenced hint must contain the rendered description.',
            );
        }
    }
}
