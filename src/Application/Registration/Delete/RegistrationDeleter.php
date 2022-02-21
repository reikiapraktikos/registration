<?php

declare(strict_types=1);

namespace App\Application\Registration\Delete;

use App\Domain\Registration\RegistrationNotFoundException;
use App\Domain\Registration\RegistrationRepositoryInterface;
use App\Domain\Shared\Id;

final class RegistrationDeleter
{
    public function __construct(private RegistrationRepositoryInterface $repository)
    {
    }

    public function __invoke(Id $id): void
    {
        $registration = $this->repository->findOneById($id);

        if ($registration === null) {
            throw new RegistrationNotFoundException($id);
        }

        $this->repository->delete($id);
    }
}
