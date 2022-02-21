<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\StringValueObject;
use InvalidArgumentException;

final class PhoneNumber extends StringValueObject
{
    private const PHONE_REGEX = '/^(6|86|\+3706)[0-9]{7}$/i';

    public function __construct(string $phoneNumber)
    {
        $this->ensureIsValid($phoneNumber);

        parent::__construct(trim($phoneNumber));
    }

    private function ensureIsValid(string $phoneNumber): void
    {
        if (preg_match(self::PHONE_REGEX, trim($phoneNumber)) !== 1) {
            throw new InvalidArgumentException(sprintf('The phone number "%s" not valid', $phoneNumber));
        }
    }
}
