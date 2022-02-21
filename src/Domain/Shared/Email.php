<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\StringValueObject;
use InvalidArgumentException;

final class Email extends StringValueObject
{
    public function __construct(string $email)
    {
        $this->ensureIsValid($email);

        parent::__construct($email);
    }

    private function ensureIsValid(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException(sprintf('The email "%s" not valid', $email));
        }
    }
}
