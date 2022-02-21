<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\IntValueObject;
use InvalidArgumentException;

final class Offset extends IntValueObject
{
    public function __construct(int $offset)
    {
        $this->ensureIsValid($offset);

        parent::__construct($offset);
    }

    private function ensureIsValid(int $offset): void
    {
        if ($offset < 0) {
            throw new InvalidArgumentException(
                sprintf('The offset "%d" not valid', $offset)
            );
        }
    }
}
