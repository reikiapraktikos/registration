<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

abstract class IntValueObject
{
    public function __construct(protected int $value)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
