<?php

declare(strict_types=1);

namespace App\Application\Registration\Delete;

use App\Domain\Shared\Command\CommandInterface;

final class DeleteRegistrationCommand implements CommandInterface
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
