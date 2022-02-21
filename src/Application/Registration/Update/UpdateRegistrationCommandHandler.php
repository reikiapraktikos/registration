<?php

declare(strict_types=1);

namespace App\Application\Registration\Update;

use App\Domain\Registration\RegistrationApartmentAddress;
use App\Domain\Registration\RegistrationName;
use App\Domain\Shared\Command\CommandHandlerInterface;
use App\Domain\Shared\Date;
use App\Domain\Shared\Email;
use App\Domain\Shared\Id;
use App\Domain\Shared\PhoneNumber;

final class UpdateRegistrationCommandHandler implements CommandHandlerInterface
{
    public function __construct(private RegistrationUpdater $updater)
    {
    }

    public function __invoke(UpdateRegistrationCommand $command): void
    {
        $id = $command->getId();
        $name = $command->getName();
        $email = $command->getEmail();
        $phoneNumber = $command->getPhoneNumber();
        $apartmentAddress = $command->getApartmentAddress();
        $date = $command->getDate();

        $this->updater->__invoke(
            new Id($id),
            $name === null ? null : new RegistrationName($name),
            $email === null ? null : new Email($email),
            $phoneNumber === null ? null : new PhoneNumber($phoneNumber),
            $apartmentAddress === null ? null : new RegistrationApartmentAddress($apartmentAddress),
            $date === null ? null : new Date($date)
        );
    }
}
