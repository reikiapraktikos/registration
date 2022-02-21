<?php

declare(strict_types=1);

namespace App\Application\Registration;

use App\Domain\Registration\Registration;
use http\Exception\InvalidArgumentException;

final class RegistrationResponseConverter
{
    public function __invoke(Registration $registration): RegistrationResponse
    {
        $id = $registration->getId();

        if ($id === null) {
            throw new InvalidArgumentException('The registration id must exist');
        }

        return new RegistrationResponse(
            $id->getValue(),
            $registration->getName()->getValue(),
            $registration->getEmail()->getValue(),
            $registration->getPhoneNumber()->getValue(),
            $registration->getApartmentAddress()->getValue(),
            $registration->getDate()->getValue(),
        );
    }
}
