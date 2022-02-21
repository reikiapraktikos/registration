<?php

declare(strict_types=1);

namespace App\Application\Registration;

use App\Domain\Shared\Query\QueryResponseInterface;

final class RegistrationsResponse implements QueryResponseInterface
{
    /** @var RegistrationResponse[] */
    private array $registrations;

    public function __construct(RegistrationResponse ...$registration)
    {
        $this->registrations = $registration;
    }

    /**
     * @return RegistrationResponse[]
     */
    public function getRegistrations(): array
    {
        return $this->registrations;
    }
}
