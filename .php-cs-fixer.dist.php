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

use CoiSA\PhpCsFixer\PhpCsFixer;

$paths = [
    __FILE__,
    __DIR__,
];

$header = file_get_contents(__DIR__ . '/.docheader');

return PhpCsFixer::create($paths, $header);
