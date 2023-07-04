<?php

namespace MentorDosNerds\PhpRenderer;

interface RendererInterface
{
    public function render(string $templatePath, array $data): string;
}
