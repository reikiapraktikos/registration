<?php

declare(strict_types=1);

use App\Application\Registration\Create\CreateRegistrationCommand;
use App\Application\Registration\Create\CreateRegistrationCommandHandler;
use App\Application\Registration\Delete\DeleteRegistrationCommand;
use App\Application\Registration\Delete\DeleteRegistrationCommandHandler;
use App\Application\Registration\FindByDate\FindRegistrationsByDateQuery;
use App\Application\Registration\FindByDate\FindRegistrationsByDateQueryHandler;
use App\Application\Registration\Update\UpdateRegistrationCommand;
use App\Application\Registration\Update\UpdateRegistrationCommandHandler;
use DI\Container;

/** @var Container $container * */
$container = require __DIR__ . '/config/bootstrap.php';
/** @var CreateRegistrationCommandHandler $createRegistrationCommandHandler * */
$createRegistrationCommandHandler = $container->get(CreateRegistrationCommandHandler::class);
/** @var DeleteRegistrationCommandHandler $deleteRegistrationCommandHandler * */
$deleteRegistrationCommandHandler = $container->get(DeleteRegistrationCommandHandler::class);
/** @var UpdateRegistrationCommandHandler $updateRegistrationCommandHandler * */
$updateRegistrationCommandHandler = $container->get(UpdateRegistrationCommandHandler::class);
/** @var FindRegistrationsByDateQueryHandler $findRegistrationsByDateQueryHandler * */
$findRegistrationsByDateQueryHandler = $container->get(FindRegistrationsByDateQueryHandler::class);

if (isset($argv[1])) {
    $useCase = strtolower(trim($argv[1]));

    if ($useCase === 'create') {
        if (isset($argv[2])) {
            $name = $argv[2];
        } else {
            throw new Exception('The name parameter missing');
        }

        if (isset($argv[3])) {
            $email = $argv[3];
        } else {
            throw new Exception('The email parameter missing');
        }

        if (isset($argv[4])) {
            $phoneNumber = $argv[4];
        } else {
            throw new Exception('The phone number parameter missing');
        }

        if (isset($argv[5])) {
            $apartmentAddress = $argv[5];
        } else {
            throw new Exception('The apartment address parameter missing');
        }

        if (isset($argv[6])) {
            $date = $argv[6];
        } else {
            throw new Exception('The date parameter missing');
        }

        $createRegistrationCommandHandler(
            new CreateRegistrationCommand(
                $name,
                $email,
                $phoneNumber,
                $apartmentAddress,
                $date,
            )
        );

        return;
    }

    if ($useCase === 'update') {
        if (isset($argv[2])) {
            $id = trim($argv[2]);

            if (ctype_digit($id)) {
                $id = (int)$id;
            } else {
                throw new Exception(sprintf('The id "%s" not valid integer', $argv[2]));
            }
        } else {
            throw new Exception('The id parameter missing');
        }

        $name = isset($argv[3]) ? $argv[3] : null;
        $email = isset($argv[4]) ? $argv[4] : null;
        $phoneNumber = isset($argv[5]) ? $argv[5] : null;
        $apartmentAddress = isset($argv[6]) ? $argv[6] : null;
        $date = isset($argv[7]) ? $argv[7] : null;

        $updateRegistrationCommandHandler(
            new UpdateRegistrationCommand(
                $id,
                $name,
                $email,
                $phoneNumber,
                $apartmentAddress,
                $date,
            )
        );

        return;
    }

    if ($useCase === 'delete') {
        if (isset($argv[2])) {
            $id = $argv[2];

            if (ctype_digit(trim($id))) {
                $id = (int)$id;
            } else {
                throw new Exception(sprintf('The id "%s" not valid integer', $argv[2]));
            }
        } else {
            throw new Exception('The id parameter missing');
        }

        $deleteRegistrationCommandHandler(new DeleteRegistrationCommand($id));

        return;
    }

    if ($useCase === 'find') {
        if (isset($argv[2])) {
            $date = $argv[2];
        } else {
            throw new Exception('The date parameter missing');
        }

        $order = isset($argv[3]) ? $argv[3] : null;
        $offset = null;
        $limit = null;

        if (isset($argv[4])) {
            $offset = trim($argv[4]);

            if (ctype_digit($offset)) {
                $offset = (int)$offset;
            } else {
                throw new Exception(sprintf('The offset "%s" not valid integer', $argv[4]));
            }
        }

        if (isset($argv[5])) {
            $limit = trim($argv[5]);

            if (ctype_digit($limit)) {
                $limit = (int)$limit;
            } else {
                throw new Exception(sprintf('The limit "%s" not valid integer', $argv[5]));
            }
        }

        foreach (
            $findRegistrationsByDateQueryHandler(
                new FindRegistrationsByDateQuery(
                    $date,
                    $order,
                    $offset,
                    $limit
                )
            )->getRegistrations() as $registration
        ) {
            echo $registration->__toString() . PHP_EOL;
        }

        return;
    }

    throw new Exception(sprintf('The use case "%s" not valid', $argv[1]));
}

throw new Exception('The use case missing');
