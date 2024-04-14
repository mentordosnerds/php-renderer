<?php

namespace MentorDosNerds\PhpRenderer\Http\Message;

use Psr\Http\Message\ResponseInterface;

interface PhpRendererResponseInterface extends ResponseInterface
{
    public function getTemplateName(): string;
    public function getContext(): array;
}
