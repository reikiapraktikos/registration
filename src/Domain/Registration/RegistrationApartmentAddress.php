<?php

declare(strict_types=1);

namespace App\Domain\Registration;

use App\Domain\Shared\ValueObject\StringValueObject;
use InvalidArgumentException;

final class RegistrationApartmentAddress extends StringValueObject
{
    public function __construct(string $address)
    {
        $this->ensureIsValid($address);

        parent::__construct(trim($address));
    }

    private function ensureIsValid(string $address): void
    {
        if (trim($address) === '') {
            throw new InvalidArgumentException(
                sprintf('The registration apartment address "%s" not valid', $address)
            );
        }
    }
}
