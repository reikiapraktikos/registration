<?php

declare(strict_types=1);

namespace App\Application\Registration\FindByDate;

use App\Application\Registration\RegistrationResponseConverter;
use App\Application\Registration\RegistrationsResponse;
use App\Domain\Shared\DateShort;
use App\Domain\Shared\Limit;
use App\Domain\Shared\Offset;
use App\Domain\Shared\Order;
use App\Domain\Shared\Query\QueryHandlerInterface;

final class FindRegistrationsByDateQueryHandler implements QueryHandlerInterface
{
    public const DEFAULT_ORDER = 'ASC';
    public const DEFAULT_OFFSET = 0;
    public const DEFAULT_LIMIT = 1000;

    public function __construct(
        private RegistrationsByDateFinder $finder,
        private RegistrationResponseConverter $converter
    ) {
    }

    public function __invoke(FindRegistrationsByDateQuery $query): RegistrationsResponse
    {
        $date = new DateShort($query->getDate());
        $order = $query->getOrder();
        $offset = $query->getOffset();
        $limit = $query->getLimit();
        $registrations = $this->finder->__invoke(
            $date,
            new Order($order === null ? self::DEFAULT_ORDER : $order),
            new Offset($offset === null ? self::DEFAULT_OFFSET : $offset),
            new Limit($limit === null ? self::DEFAULT_LIMIT : $limit)
        );
        $registrationResponses = [];

        foreach ($registrations as $registration) {
            $registrationResponses[] = $this->converter->__invoke($registration);
        }

        return new RegistrationsResponse(...$registrationResponses);
    }
}
