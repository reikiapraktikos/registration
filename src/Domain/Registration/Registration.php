<?php

declare(strict_types=1);

namespace App\Domain\Registration;

use App\Domain\Shared\Date;
use App\Domain\Shared\Email;
use App\Domain\Shared\Id;
use App\Domain\Shared\PhoneNumber;

final class Registration
{
    public function __construct(
        private ?Id $id,
        private RegistrationName $name,
        private Email $email,
        private PhoneNumber $phoneNumber,
        private RegistrationApartmentAddress $apartmentAddress,
        private Date $date
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function setId(Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): RegistrationName
    {
        return $this->name;
    }

    public function setName(RegistrationName $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(PhoneNumber $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getApartmentAddress(): RegistrationApartmentAddress
    {
        return $this->apartmentAddress;
    }

    public function setApartmentAddress(RegistrationApartmentAddress $apartmentAddress): self
    {
        $this->apartmentAddress = $apartmentAddress;

        return $this;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function setDate(Date $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function update(
        ?RegistrationName $name,
        ?Email $email,
        ?PhoneNumber $phoneNumber,
        ?RegistrationApartmentAddress $apartmentAddress,
        ?Date $date
    ): self {
        if ($name !== null) {
            $this->setName($name);
        }

        if ($email !== null) {
            $this->setEmail($email);
        }

        if ($phoneNumber !== null) {
            $this->setPhoneNumber($phoneNumber);
        }

        if ($apartmentAddress !== null) {
            $this->setApartmentAddress($apartmentAddress);
        }

        if ($date !== null) {
            $this->setDate($date);
        }

        return $this;
    }
}
