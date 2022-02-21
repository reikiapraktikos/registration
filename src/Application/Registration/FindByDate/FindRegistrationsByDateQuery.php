<?php

declare(strict_types=1);

namespace App\Application\Registration\FindByDate;

use App\Domain\Shared\Query\QueryInterface;

final class FindRegistrationsByDateQuery implements QueryInterface
{
    public function __construct(
        private string $date,
        private ?string $order = null,
        private ?int $offset = null,
        private ?int $limit = null,
    ) {
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getOrder(): ?string
    {
        return $this->order;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
