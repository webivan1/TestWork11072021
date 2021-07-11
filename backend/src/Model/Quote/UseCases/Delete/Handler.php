<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Delete;

use App\Model\Quote\Entities\Quote;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function delete(Quote $quote): void
    {
        $this->em->remove($quote);
        $this->em->flush();
    }
}
