<?php

declare(strict_types=1);

namespace App\Application\Registration;

use App\Domain\Shared\Date;
use App\Domain\Shared\Query\QueryResponseInterface;
use DateTimeInterface;

final class RegistrationResponse implements QueryResponseInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $phoneNumber,
        private string $apartmentAddress,
        private DateTimeInterface $date,
    ) {
    }

    private function getId(): int
    {
        return $this->id;
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getEmail(): string
    {
        return $this->email;
    }

    private function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    private function getApartmentAddress(): string
    {
        return $this->apartmentAddress;
    }

    private function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function __toString(): string
    {
        return sprintf(
            '%d %s %s %s %s %s',
            $this->getId(),
            $this->getName(),
            $this->getEmail(),
            $this->getPhoneNumber(),
            $this->getApartmentAddress(),
            $this->getDate()->format(Date::DATE_FORMAT)
        );
    }
}
