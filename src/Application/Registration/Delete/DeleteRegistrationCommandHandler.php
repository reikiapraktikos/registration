<?php

declare(strict_types=1);

namespace App\Application\Registration\Delete;

use App\Domain\Shared\Command\CommandHandlerInterface;
use App\Domain\Shared\Id;

final class DeleteRegistrationCommandHandler implements CommandHandlerInterface
{
    public function __construct(private RegistrationDeleter $deleter)
    {
    }

    public function __invoke(DeleteRegistrationCommand $command): void
    {
        $this->deleter->__invoke(new Id($command->getId()));
    }
}
