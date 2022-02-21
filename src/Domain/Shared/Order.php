<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\StringValueObject;
use InvalidArgumentException;

final class Order extends StringValueObject
{
    private const ASC = 'ASC';
    private const DESC = 'DESC';

    public function __construct(string $order)
    {
        $this->ensureIsValid($order);

        parent::__construct(strtoupper(trim($order)));
    }

    private function ensureIsValid(string $order): void
    {
        $convertOrder = strtoupper(trim($order));

        if (!($convertOrder === self::ASC || $convertOrder === self::DESC)) {
            throw new InvalidArgumentException(sprintf('The order "%s" not valid', $order));
        }
    }
}
