<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Registration\Registration;
use App\Domain\Registration\RegistrationApartmentAddress;
use App\Domain\Registration\RegistrationName;
use App\Domain\Registration\RegistrationRepositoryInterface;
use App\Domain\Shared\Date;
use App\Domain\Shared\DateShort;
use App\Domain\Shared\Email;
use App\Domain\Shared\Id;
use App\Domain\Shared\Limit;
use App\Domain\Shared\Offset;
use App\Domain\Shared\Order;
use App\Domain\Shared\PhoneNumber;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

final class RegistrationRepository implements RegistrationRepositoryInterface
{
    private QueryBuilder $queryBuilder;

    public function __construct(Connection $connection)
    {
        $this->queryBuilder = $connection->createQueryBuilder();
    }

    /**
     * @param Registration $registration
     * @throws Exception
     */
    public function create(Registration $registration): void
    {
        $this
            ->queryBuilder
            ->insert('registration')
            ->values([
                'name' => ':name',
                'email' => ':email',
                'phone_number' => ':phone_number',
                'apartment_address' => ':apartment_address',
                'date' => ':date',
            ])
            ->setParameters([
                'name' => $registration->getName()->getValue(),
                'email' => $registration->getEmail()->getValue(),
                'phone_number' => $registration->getPhoneNumber()->getValue(),
                'apartment_address' => $registration->getApartmentAddress()->getValue(),
                'date' => $registration->getDate()->getValue()->format(Date::DATE_FORMAT),
            ])
            ->executeQuery();
    }

    /**
     * @param Registration $registration
     * @throws Exception
     */
    public function update(Registration $registration): void
    {
        $this
            ->queryBuilder
            ->update('registration')
            ->set('name', ':name')
            ->set('email', ':email')
            ->set('phone_number', ':phone_number')
            ->set('apartment_address', ':apartment_address')
            ->set('date', ':date')
            ->where('id = :id')
            ->setParameters([
                'name' => $registration->getName()->getValue(),
                'email' => $registration->getEmail()->getValue(),
                'phone_number' => $registration->getPhoneNumber()->getValue(),
                'apartment_address' => $registration->getApartmentAddress()->getValue(),
                'date' => $registration->getDate()->getValue()->format(Date::DATE_FORMAT),
                'id' => $registration->getId()->getValue()
            ])
            ->executeQuery();
    }

    /**
     * @param Id $id
     * @throws Exception
     */
    public function delete(Id $id): void
    {
        $this
            ->queryBuilder
            ->delete('registration')
            ->where('id = :id')
            ->setParameter('id', $id->getValue())
            ->executeQuery();
    }

    /**
     * @param Id $id
     * @return Registration|null
     * @throws Exception
     */
    public function findOneById(Id $id): ?Registration
    {
        $result = $this
            ->queryBuilder
            ->select('*')
            ->from('registration')
            ->where('id = :id')
            ->setParameter('id', $id->getValue())
            ->setMaxResults(1)
            ->fetchAssociative();

        return $result === false ?
            null :
            new Registration(
                new Id($result['id']),
                new RegistrationName($result['name']),
                new Email($result['email']),
                new PhoneNumber($result['phone_number']),
                new RegistrationApartmentAddress($result['apartment_address']),
                new Date($result['date']),
            );
    }

    /**
     * @param DateShort $date
     * @param Order $order
     * @param Offset $offset
     * @param Limit $limit
     * @return Registration[]
     * @throws Exception
     */
    public function findByDate(DateShort $date, Order $order, Offset $offset, Limit $limit): array
    {
        $registrations = [];
        $result = $this
            ->queryBuilder
            ->select('*')
            ->from('registration')
            ->where('DATE(date) = :date')
            ->setParameter('date', $date->getValue()->format(DateShort::DATE_FORMAT))
            ->setFirstResult($offset->getValue())
            ->setMaxResults($limit->getValue())
            ->orderBy('date', $order->getValue())
            ->fetchAllAssociative();

        foreach ($result as $row) {
            $registrations[] = new Registration(
                new Id($row['id']),
                new RegistrationName($row['name']),
                new Email($row['email']),
                new PhoneNumber($row['phone_number']),
                new RegistrationApartmentAddress($row['apartment_address']),
                new Date($row['date']),
            );
        }

        return $registrations;
    }
}
