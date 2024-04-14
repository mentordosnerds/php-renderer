<?php

namespace MentorDosNerds\PhpRenderer;

use Twig\Environment;
use Twig\Error\LoaderError;
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
