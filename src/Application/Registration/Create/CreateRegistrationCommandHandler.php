<?php

declare(strict_types=1);

namespace App\Application\Registration\Create;

use App\Domain\Registration\RegistrationApartmentAddress;
use App\Domain\Registration\RegistrationName;
use App\Domain\Shared\Command\CommandHandlerInterface;
use App\Domain\Shared\Date;
use App\Domain\Shared\Email;
use App\Domain\Shared\PhoneNumber;

final class CreateRegistrationCommandHandler implements CommandHandlerInterface
{
    public function __construct(private RegistrationCreator $creator)
    {
    }

    public function __invoke(CreateRegistrationCommand $command): void
    {
        $this->creator->__invoke(
            new RegistrationName($command->getName()),
            new Email($command->getEmail()),
            new PhoneNumber($command->getPhoneNumber()),
            new RegistrationApartmentAddress($command->getApartmentAddress()),
            new Date($command->getDate())
        );
    }
}
