<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\IntValueObject;
use InvalidArgumentException;

final class Limit extends IntValueObject
{
    private const MAX_LIMIT = 10000;

    public function __construct(int $limit)
    {
        $this->ensureIsValid($limit);

        parent::__construct($limit);
    }

    private function ensureIsValid(int $limit): void
    {
        if ($limit > self::MAX_LIMIT) {
            throw new InvalidArgumentException(
                sprintf('The limit "%d" not valid', $limit)
            );
        }
    }
}
