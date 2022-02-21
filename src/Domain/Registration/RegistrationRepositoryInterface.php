<?php

declare(strict_types=1);

namespace App\Domain\Registration;

use App\Domain\Shared\DateShort;
use App\Domain\Shared\Id;
use App\Domain\Shared\Limit;
use App\Domain\Shared\Offset;
use App\Domain\Shared\Order;

interface RegistrationRepositoryInterface
{
    public function create(Registration $registration): void;

    public function update(Registration $registration): void;

    public function delete(Id $id): void;

    public function findOneById(Id $id): ?Registration;

    /**
     * @param DateShort $date
     * @param Order $order
     * @param Offset $offset
     * @param Limit $limit
     * @return Registration[]
     */
    public function findByDate(DateShort $date, Order $order, Offset $offset, Limit $limit): array;
}
