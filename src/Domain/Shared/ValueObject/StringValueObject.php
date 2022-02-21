<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
