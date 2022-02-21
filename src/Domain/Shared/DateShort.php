<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\ValueObject\DateTimeValueObject;
use DateTimeImmutable;
use InvalidArgumentException;

class DateShort extends DateTimeValueObject
{
    public const DATE_FORMAT = 'Y-m-d';

    public function __construct(string $date)
    {
        $this->ensureIsValid($date);

        parent::__construct(DateTimeImmutable::createFromFormat(self::DATE_FORMAT, trim($date)));
    }

    private function ensureIsValid(string $date): void
    {
        $dateTime = DateTimeImmutable::createFromFormat(self::DATE_FORMAT, trim($date));

        if (!($dateTime && $dateTime->format(self::DATE_FORMAT))) {
            throw new InvalidArgumentException(sprintf('The date "%s" not valid', $date));
        }
    }
}
