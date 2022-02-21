<?php

declare(strict_types=1);

namespace App\Application\Registration\Update;

use App\Domain\Shared\Command\CommandInterface;

final class UpdateRegistrationCommand implements CommandInterface
{
    public function __construct(
        private int $id,
        private ?string $name,
        private ?string $email,
        private ?string $phoneNumber,
        private ?string $apartmentAddress,
        private ?string $date
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getApartmentAddress(): ?string
    {
        return $this->apartmentAddress;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }
}
