<?php

declare(strict_types=1);

/**
 * This file is part of mentordosnerds/php-renderer.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/mentordosnerds/php-renderer
 * @copyright Copyright (c) 2020-2024 Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace MentorDosNerds\PhpRenderer;

use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;

final class TwigRenderer implements RendererInterface
{
    public function __construct(
        private Environment $environment,
    ) {
        if (class_exists(IntlExtension::class)) {
            $this->environment->addExtension(new IntlExtension());
        }
    }

    public function render(string $name, array $context = []): string
    {
        return $this->environment->render($name, $context);
    }
}
