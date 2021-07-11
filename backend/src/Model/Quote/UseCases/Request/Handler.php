<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Request;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\Repositories\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ObjectRepository;
use JetBrains\PhpStorm\ArrayShape;

class Handler
{
    private ObjectRepository|QuoteRepository $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repo = $entityManager->getRepository(Quote::class);
    }

    public function getList(Command $command, int $perPage = 30): array
    {
        $paginator = $this->repo->getList($command, $perPage);

        return [
            'total' => $total = $paginator->count(),
            'models' => $paginator->getQuery()->getResult(),
            'perPage' => $perPage,
            'currentPage' => $command->currentPage,
            'countPages' => ceil($total / $perPage)
        ];
    }
}
