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

final class PhpRenderer implements RendererInterface
{
    private array $data;

    public function __construct(
        private string $templatesDirectory,
    ) {}

    public function render(string $name, array $context = []): string
    {
        $templatePath = $this->templatesDirectory . \DIRECTORY_SEPARATOR . $name . '.php';

        if (!file_exists($templatePath)) {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found', $templatePath));
        }

        $this->data = $context;

        ob_start();

        include $templatePath;

        return ob_get_clean();
    }
}
