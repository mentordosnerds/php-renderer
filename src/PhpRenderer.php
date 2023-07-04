<?php

namespace MentorDosNerds\PhpRenderer;

final class PhpRenderer implements RendererInterface
{
    private array $data;

    public function __construct(
        private string $templatesDirectory,
    ) {}

    public function render(string $templatePath, array $data = []): string
    {
        $templatePath = $this->templatesDirectory . DIRECTORY_SEPARATOR . $templatePath . '.php';

        if (!file_exists($templatePath)) {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found', $templatePath));
        }

        $this->data = $data;

        ob_start();
        include $templatePath;
        $content = ob_get_clean();

        return $content;
    }
}
