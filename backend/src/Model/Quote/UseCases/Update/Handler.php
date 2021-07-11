<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Update;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\Entities\Values;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function update(Quote $quote, Command $command): void
    {
        $quote->update(
            new Values\Task($command->task),
            new Values\Amount($command->amount),
            new Values\Percentage($command->percentage),
            new Values\Reference($command->reference)
        );

        $this->em->persist($quote);
        $this->em->flush();
    }
}
