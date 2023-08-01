<?php

namespace MentorDosNerds\PhpRenderer\Http\Message;

use Psr\Http\Message\ResponseInterface;

interface PhpRendererResponseInterface extends ResponseInterface
{
    public function getTemplatePath(): string;
    public function getAttributes(): array;
}
