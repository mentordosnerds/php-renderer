<?php

namespace MentorDosNerds\PhpRenderer;

interface RendererInterface
{
    public function render(string $name, array $context): string;
}
