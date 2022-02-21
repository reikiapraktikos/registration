<?php

declare(strict_types=1);

namespace App\Domain\Registration;

use App\Domain\Shared\Id;
use DomainException;

final class RegistrationNotFoundException extends DomainException
{
    public function __construct(private Id $id)
    {
        parent::__construct(sprintf('The registration "%s" not found', $this->id->getValue()));
    }
}
