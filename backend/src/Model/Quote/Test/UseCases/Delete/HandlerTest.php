<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\UseCases\Delete;

use App\Model\Quote\Entities\Quote;
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
        $quote = $this->createQuote();
        $currentId = $quote->getId();

        /** @var UseCases\Delete\Handler $handler */
        $handler = $this->getContainer()->get(UseCases\Delete\Handler::class);

        $handler->delete($quote);

        $this->assertNotNull($currentId);
        $this->assertNull($quote->getId());
    }
}
