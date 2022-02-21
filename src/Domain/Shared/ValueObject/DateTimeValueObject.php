<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use DateTimeInterface;

abstract class DateTimeValueObject
{
    public function __construct(protected DateTimeInterface $value)
    {
    }

    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }
}
