<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\UseCases\Request;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\Repositories\QuoteRepository;
use App\Model\Quote\UseCases;
use App\Tests\DatabaseWebTest;

class HandlerTest extends DatabaseWebTest
{
    public function createQuote(): Quote
    {
        /** @var UseCases\Create\Handler $handler */
        $handler = $this->getContainer()->get(UseCases\Create\Handler::class);
        $command = new UseCases\Create\Command();
        $command->task = 'Task test';
        $command->amount = 45.78;
        $command->percentage = 5;
        return $handler->create($command);
    }

    public function testSuccess()
    {
        /** @var QuoteRepository $repo */
        $repo = $this->em->getRepository(Quote::class);

        $total = $repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if ($total === 0) {
            for ($i = 0; $i < 5; $i++) {
                $this->createQuote();
                $total++;
            }
        }

        $perPage = 2;
        $totalPages = ceil($total / $perPage);
        $totalPages = $totalPages > 3 ? 3 : $totalPages;

        /** @var UseCases\Request\Handler $handler */
        $handler = $this->getContainer()->get(UseCases\Request\Handler::class);

        for ($curPage = 1; $curPage <= $totalPages; $curPage++) {
            $command = new UseCases\Request\Command();
            $command->currentPage = $curPage;
            $result = $handler->getList($command, $perPage);

            $this->assertEquals($result['total'], $total);
            $this->assertEquals($result['perPage'], $perPage);
            $this->assertEquals($result['currentPage'], $curPage);
            $this->assertEquals($result['countPages'], ceil($total / $perPage));
            $this->assertTrue(count($result['models']) <= $perPage);
        }
    }
}
