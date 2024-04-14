<?php

namespace MentorDosNerds\PhpRenderer;

final class PhpRenderer implements RendererInterface
{
    private array $data;

    public function __construct(
        private string $templatesDirectory,
    ) {}

    public function render(string $name, array $context = []): string
    {
        $templatePath = $this->templatesDirectory . DIRECTORY_SEPARATOR . $name . '.php';

        if (!file_exists($templatePath)) {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found', $templatePath));
        }

        $this->data = $context;

        ob_start();
        include $templatePath;

        return ob_get_clean();
    }
}
