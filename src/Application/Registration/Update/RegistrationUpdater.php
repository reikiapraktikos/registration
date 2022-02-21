<?php

declare(strict_types=1);

namespace App\Application\Registration\Update;

use App\Domain\Registration\RegistrationApartmentAddress;
use App\Domain\Registration\RegistrationName;
use App\Domain\Registration\RegistrationNotFoundException;
use App\Domain\Registration\RegistrationRepositoryInterface;
use App\Domain\Shared\Date;
use App\Domain\Shared\Email;
use App\Domain\Shared\Id;
use App\Domain\Shared\PhoneNumber;

final class RegistrationUpdater
{
    public function __construct(private RegistrationRepositoryInterface $repository)
    {
    }

    public function __invoke(
        Id $id,
        ?RegistrationName $name,
        ?Email $email,
        ?PhoneNumber $phoneNumber,
        ?RegistrationApartmentAddress $apartmentAddress,
        ?Date $date
    ): void {
        $registration = $this->repository->findOneById($id);

        if ($registration === null) {
            throw new RegistrationNotFoundException($id);
        }

        $this->repository->update($registration->update($name, $email, $phoneNumber, $apartmentAddress, $date));
    }
}
