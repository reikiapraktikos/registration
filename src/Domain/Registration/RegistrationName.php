<?php

declare(strict_types=1);

namespace App\Domain\Registration;

use App\Domain\Shared\ValueObject\StringValueObject;
use InvalidArgumentException;

final class RegistrationName extends StringValueObject
{
    public function __construct(string $name)
    {
        $this->ensureIsValid($name);

        parent::__construct(trim($name));
    }

    private function ensureIsValid(string $name): void
    {
        if (trim($name) === '') {
            throw new InvalidArgumentException(
                sprintf('The registration name "%s" not valid', $name)
            );
        }
    }
}
