<?php

declare(strict_types=1);

namespace App\Application\Registration\Create;

use App\Domain\Registration\Registration;
use App\Domain\Registration\RegistrationApartmentAddress;
use App\Domain\Registration\RegistrationName;
use App\Domain\Registration\RegistrationRepositoryInterface;
use App\Domain\Shared\Date;
use App\Domain\Shared\Email;
use App\Domain\Shared\PhoneNumber;

final class RegistrationCreator
{
    public function __construct(private RegistrationRepositoryInterface $repository)
    {
    }

    public function __invoke(
        RegistrationName $name,
        Email $email,
        PhoneNumber $phoneNumber,
        RegistrationApartmentAddress $apartmentAddress,
        Date $date
    ): void {
        $this->repository->create(new Registration(null, $name, $email, $phoneNumber, $apartmentAddress, $date));
    }
}
