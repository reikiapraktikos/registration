<?php

declare(strict_types=1);

namespace App\Application\Registration\FindByDate;

use App\Domain\Registration\Registration;
use App\Domain\Registration\RegistrationRepositoryInterface;
use App\Domain\Shared\DateShort;
use App\Domain\Shared\Limit;
use App\Domain\Shared\Offset;
use App\Domain\Shared\Order;

final class RegistrationsByDateFinder
{
    public function __construct(private RegistrationRepositoryInterface $repository)
    {
    }

    /**
     * @param DateShort $date
     * @param Order $order
     * @param Offset $offset
     * @param Limit $limit
     * @return Registration[]
     */
    public function __invoke(DateShort $date, Order $order, Offset $offset, Limit $limit): array
    {
        return $this->repository->findByDate($date, $order, $offset, $limit);
    }
}
