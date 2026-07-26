<?php

declare(strict_types=1);

namespace UIAwesome\Html\Field\Tests\Support;

use UIAwesome\Html\Core\Config\{ComponentContext, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;

/**
 * Test theme recording every resolved component context.
 */
final class RecordingTheme implements ThemeInterface
{
    /**
     * @var list<ComponentContext> Resolved component contexts in application order.
     */
    public array $contexts = [];

    public function getName(): string
    {
        return 'recording';
    }

    /**
     * @return iterable<Recipe>
     */
    public function getRecipes(ComponentContext $context): iterable
    {
        $this->contexts[] = $context;

        return [];
    }
}
