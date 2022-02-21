<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\IntValueObject;
use InvalidArgumentException;

final class Id extends IntValueObject
{
    private const MIN_ID = 1;

    public function __construct(int $id)
    {
        $this->ensureIsValid($id);

        parent::__construct($id);
    }

    private function ensureIsValid(int $id): void
    {
        if ($id < self::MIN_ID) {
            throw new InvalidArgumentException(
                sprintf('The id "%s" not valid', $id)
            );
        }
    }
}
