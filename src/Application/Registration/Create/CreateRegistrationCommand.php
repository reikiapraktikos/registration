<?php

declare(strict_types=1);

namespace App\Application\Registration\Create;

use App\Domain\Shared\Command\CommandInterface;

final class CreateRegistrationCommand implements CommandInterface
{
    public function __construct(
        private string $name,
        private string $email,
        private string $phoneNumber,
        private string $apartmentAddress,
        private string $date
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getApartmentAddress(): string
    {
        return $this->apartmentAddress;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
