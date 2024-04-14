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

namespace MentorDosNerds\PhpRenderer\Http\Middleware;

use MentorDosNerds\PhpRenderer\Http\Message\PhpRendererResponseInterface;
use MentorDosNerds\PhpRenderer\RendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class PhpRendererMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly RendererInterface $renderer,
        private readonly StreamFactoryInterface $streamFactory,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        if (!$response instanceof PhpRendererResponseInterface) {
            return $response;
        }

        $name    = $response->getTemplateName();
        $context = $response->getContext();

        $html   = $this->renderer->render($name, $context);
        $stream = $this->streamFactory->createStream($html);

        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withBody($stream)
        ;
    }
}
