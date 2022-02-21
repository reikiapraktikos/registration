<?php

declare(strict_types=1);

use App\Infrastructure\RegistrationRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use App\Domain\Registration\RegistrationRepositoryInterface;

return [
    RegistrationRepositoryInterface::class =>
        DI\create(RegistrationRepository::class)->constructor(DI\get(Connection::class)),
    Connection::class => fn () => DriverManager::getConnection(['url' => getenv('DATABASE_URL')])
];
