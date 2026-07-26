<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field;

/**
 * Renders a form model property as a complete field with label, hint, error, prefix, suffix, and container.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Field\Field::tag()
 *     ->formModel($formModel)
 *     ->property('username')
 *     ->render();
 * ```
 */
final class Field extends Base\AbstractField {}
