<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Provider;

/**
 * Provides complete HTML expectations for {@see \UIAwesome\Html\Field\Tests\LabelEnclosureTest}.
 */
final class LabelEnclosureProvider
{
    /**
     * @return iterable<string, array{string, bool, string, string}>
     */
    public static function choiceLists(): iterable
    {
        yield 'checkbox-list, enclosure off, normal label' => [
            'checkbox-list',
            false,
            'normal',
            <<<HTML
            <div>
            <label>Choices &amp; &lt;all&gt;</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'checkbox-list, enclosure off, disabled label' => [
            'checkbox-list',
            false,
            'disabled',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'checkbox-list, enclosure off, empty label' => [
            'checkbox-list',
            false,
            'empty',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'checkbox-list, enclosure on, normal label' => [
            'checkbox-list',
            true,
            'normal',
            <<<HTML
            <div>
            <label>Choices &amp; &lt;all&gt;</label>
            <div id="basicform-label">
            <label for="basicform-label-0"><input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">A &amp; B</label>
            <label for="basicform-label-1"><input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'checkbox-list, enclosure on, disabled label' => [
            'checkbox-list',
            true,
            'disabled',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'checkbox-list, enclosure on, empty label' => [
            'checkbox-list',
            true,
            'empty',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label][]" type="checkbox" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label][]" type="checkbox" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure off, normal label' => [
            'radio-list',
            false,
            'normal',
            <<<HTML
            <div>
            <label>Choices &amp; &lt;all&gt;</label>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure off, disabled label' => [
            'radio-list',
            false,
            'disabled',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure off, empty label' => [
            'radio-list',
            false,
            'empty',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure on, normal label' => [
            'radio-list',
            true,
            'normal',
            <<<HTML
            <div>
            <label>Choices &amp; &lt;all&gt;</label>
            <div id="basicform-label">
            <label for="basicform-label-0"><input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">A &amp; B</label>
            <label for="basicform-label-1"><input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure on, disabled label' => [
            'radio-list',
            true,
            'disabled',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
        yield 'radio-list, enclosure on, empty label' => [
            'radio-list',
            true,
            'empty',
            <<<HTML
            <div>
            <div id="basicform-label">
            <input id="basicform-label-0" name="BasicForm[label]" type="radio" value="1">
            <label for="basicform-label-0">A &amp; B</label>
            <input id="basicform-label-1" name="BasicForm[label]" type="radio" value="2">
            <label for="basicform-label-1">Second</label>
            </div>
            </div>
            HTML,
        ];
    }

    /**
     * @return iterable<string, array{string, bool, string, string}>
     */
    public static function singleControls(): iterable
    {
        yield 'text, enclosure off, normal label' => [
            'text',
            false,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">This is a label.</label>
            <input id="basicform-label" name="BasicForm[label]" type="text">
            </div>
            HTML,
        ];
        yield 'text, enclosure off, disabled label' => [
            'text',
            false,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="text">
            </div>
            HTML,
        ];
        yield 'text, enclosure off, empty label' => [
            'text',
            false,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="text">
            </div>
            HTML,
        ];
        yield 'text, enclosure on, normal label' => [
            'text',
            true,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">This is a label.<input id="basicform-label" name="BasicForm[label]" type="text"></label>
            </div>
            HTML,
        ];
        yield 'text, enclosure on, disabled label' => [
            'text',
            true,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="text">
            </div>
            HTML,
        ];
        yield 'text, enclosure on, empty label' => [
            'text',
            true,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="text">
            </div>
            HTML,
        ];
        yield 'textarea, enclosure off, normal label' => [
            'textarea',
            false,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">This is a label.</label>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
        ];
        yield 'textarea, enclosure off, disabled label' => [
            'textarea',
            false,
            'disabled',
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
        ];
        yield 'textarea, enclosure off, empty label' => [
            'textarea',
            false,
            'empty',
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
        ];
        yield 'textarea, enclosure on, normal label' => [
            'textarea',
            true,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">This is a label.<textarea id="basicform-label" name="BasicForm[label]">\n</textarea></label>
            </div>
            HTML,
        ];
        yield 'textarea, enclosure on, disabled label' => [
            'textarea',
            true,
            'disabled',
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
        ];
        yield 'textarea, enclosure on, empty label' => [
            'textarea',
            true,
            'empty',
            <<<HTML
            <div>
            <textarea id="basicform-label" name="BasicForm[label]">\n</textarea>
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure off, normal label' => [
            'checkbox',
            false,
            'normal',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            <label for="basicform-label">This is a label.</label>
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure off, disabled label' => [
            'checkbox',
            false,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure off, empty label' => [
            'checkbox',
            false,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure on, normal label' => [
            'checkbox',
            true,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            This is a label.
            </label>
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure on, disabled label' => [
            'checkbox',
            true,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
        ];
        yield 'checkbox, enclosure on, empty label' => [
            'checkbox',
            true,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="checkbox">
            </div>
            HTML,
        ];
        yield 'radio, enclosure off, normal label' => [
            'radio',
            false,
            'normal',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            <label for="basicform-label">This is a label.</label>
            </div>
            HTML,
        ];
        yield 'radio, enclosure off, disabled label' => [
            'radio',
            false,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
        ];
        yield 'radio, enclosure off, empty label' => [
            'radio',
            false,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
        ];
        yield 'radio, enclosure on, normal label' => [
            'radio',
            true,
            'normal',
            <<<HTML
            <div>
            <label for="basicform-label">
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            This is a label.
            </label>
            </div>
            HTML,
        ];
        yield 'radio, enclosure on, disabled label' => [
            'radio',
            true,
            'disabled',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
        ];
        yield 'radio, enclosure on, empty label' => [
            'radio',
            true,
            'empty',
            <<<HTML
            <div>
            <input id="basicform-label" name="BasicForm[label]" type="radio">
            </div>
            HTML,
        ];
    }
}
