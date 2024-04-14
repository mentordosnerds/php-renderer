<?php

namespace MentorDosNerds\PhpRenderer\Http\Message;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class PhpRendererResponseDecorator implements PhpRendererResponseInterface
{

    public function __construct(
        private readonly ResponseInterface $response,
        private readonly string $templateName,
        private readonly array $context = [],
    ) {}

    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    /** {@inheritdoc} */
    public function withProtocolVersion($version): MessageInterface
    {
        return new self(
            $this->response->withProtocolVersion($version),
            $this->templateName,
            $this->context,
        );
    }

    /** {@inheritdoc} */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /** {@inheritdoc} */
    public function hasHeader($name): bool
    {
        return $this->response->hasHeader($name);
    }

    /** {@inheritdoc} */
    public function getHeader($name): array
    {
        return $this->response->getHeader($name);
    }

    /** {@inheritdoc} */
    public function getHeaderLine($name): string
    {
        return $this->response->getHeaderLine($name);
    }

    /** {@inheritdoc} */
    public function withHeader($name, $value): self
    {
        return new self(
            $this->response->withHeader($name, $value),
            $this->templateName,
            $this->context,
        );
    }

    /** {@inheritdoc} */
    public function withAddedHeader($name, $value): self
    {
        return new self(
            $this->response->withAddedHeader($name, $value),
            $this->templateName,
            $this->context,
        );
    }

    /** {@inheritdoc} */
    public function withoutHeader($name): self
    {
        return new self(
            $this->response->withoutHeader($name),
            $this->templateName,
            $this->context,
        );
    }

    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    /** {@inheritdoc} */
    public function withBody(StreamInterface $body): self
    {
        return new self(
            $this->response->withBody($body),
            $this->templateName,
            $this->context,
        );
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /** {@inheritdoc} */
    public function withStatus($code, $reasonPhrase = ''): self
    {
        return new self(
            $this->response->withStatus($code, $reasonPhrase),
            $this->templateName,
            $this->context,
        );
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }

    /**
     * Returns an instance with the specified attribute
     */
    public function withContext(string $name, mixed $value): self
    {
        return new self(
            $this->response,
            $this->templateName,
            [$name => $value] + $this->context,
        );
    }

    /**
     * Retrieve the configured context
     *
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }

    public function withTemplateName(string $name): self
    {
        return new self($this->response, $name, $this->context);
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }
}
