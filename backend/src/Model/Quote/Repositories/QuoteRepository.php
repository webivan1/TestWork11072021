<?php

namespace App\Model\Quote\Repositories;

use App\Model\Quote\Entities\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use App\Model\Quote\UseCases\Request\Command;

/**
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    public function getList(Command $command, int $perPage): Paginator
    {
        $query = $this->createQueryBuilder('t')
            ->setMaxResults($perPage)
            ->setFirstResult($perPage * ($command->currentPage - 1))
            ->orderBy('t.id', 'DESC');

        if ($command->task) {
            $query->andWhere('t.task LIKE %:task%')
                ->setParameter('task', $command->task);
        }

        if ($command->id) {
            $query->andWhere('t.id = :id')
                ->setParameter('id', $command->id);
        }

        return new Paginator($query->getQuery());
    }
}
