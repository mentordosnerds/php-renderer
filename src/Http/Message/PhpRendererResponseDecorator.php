<?php

namespace MentorDosNerds\PhpRenderer\Http\Message;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class PhpRendererResponseDecorator implements PhpRendererResponseInterface
{
    public const DEFAULT_TEMPLATE = 'index';

    public function __construct(
        private readonly ResponseInterface $decoratedResponse,
        private readonly string $templatePath = self::DEFAULT_TEMPLATE,
        private readonly array $attributes = [],
    ) {}

    public function getProtocolVersion(): string
    {
        return $this->decoratedResponse->getProtocolVersion();
    }

    /** {@inheritdoc} */
    public function withProtocolVersion($version): MessageInterface
    {
        return new self(
            $this->decoratedResponse->withProtocolVersion($version),
            $this->templatePath,
            $this->attributes,
        );
    }

    /** {@inheritdoc} */
    public function getHeaders(): array
    {
        return $this->decoratedResponse->getHeaders();
    }

    /** {@inheritdoc} */
    public function hasHeader($name): bool
    {
        return $this->decoratedResponse->hasHeader($name);
    }

    /** {@inheritdoc} */
    public function getHeader($name): array
    {
        return $this->decoratedResponse->getHeader($name);
    }

    /** {@inheritdoc} */
    public function getHeaderLine($name): string
    {
        return $this->decoratedResponse->getHeaderLine($name);
    }

    /** {@inheritdoc} */
    public function withHeader($name, $value): self
    {
        return new self(
            $this->decoratedResponse->withHeader($name, $value),
            $this->templatePath,
            $this->attributes,
        );
    }

    /** {@inheritdoc} */
    public function withAddedHeader($name, $value): self
    {
        return new self(
            $this->decoratedResponse->withAddedHeader($name, $value),
            $this->templatePath,
            $this->attributes,
        );
    }

    /** {@inheritdoc} */
    public function withoutHeader($name): self
    {
        return new self(
            $this->decoratedResponse->withoutHeader($name),
            $this->templatePath,
            $this->attributes,
        );
    }

    public function getBody(): StreamInterface
    {
        return $this->decoratedResponse->getBody();
    }

    /** {@inheritdoc} */
    public function withBody(StreamInterface $body): self
    {
        return new self(
            $this->decoratedResponse->withBody($body),
            $this->templatePath,
            $this->attributes,
        );
    }

    public function getStatusCode(): int
    {
        return $this->decoratedResponse->getStatusCode();
    }

    /** {@inheritdoc} */
    public function withStatus($code, $reasonPhrase = ''): self
    {
        return new self(
            $this->decoratedResponse->withStatus($code, $reasonPhrase),
            $this->templatePath,
            $this->attributes,
        );
    }

    public function getReasonPhrase(): string
    {
        return $this->decoratedResponse->getReasonPhrase();
    }

    /**
     * Returns an instance with the specified attribute
     */
    public function withAttribute(string $name, mixed $value): self
    {
        return new self(
            $this->decoratedResponse,
            $this->templatePath,
            [$name => $value] + $this->attributes,
        );
    }

    /**
     * Retrieve the configured attributes
     *
     * @return array<string, mixed>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function withTemplatePath(string $templatePath): self
    {
        return new self(
            $this->decoratedResponse,
            $templatePath,
            $this->attributes,
        );
    }

    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }
}