<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\UseCases\Update;

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
        $previousQuote = clone $quote;

        /** @var UseCases\Update\Handler $handler */
        $handler = $this->getContainer()->get(UseCases\Update\Handler::class);

        $command = new UseCases\Update\Command();
        $command->task = 'Task test 2';
        $command->amount = 30;
        $command->percentage = 5;
        $command->reference = 'Some text...';

        $handler->update($quote, $command);

        $this->assertEquals($previousQuote->getId(), $quote->getId());
        $this->assertNotEquals($previousQuote->getTask(), $quote->getTask());
        $this->assertNotEquals($previousQuote->getAmount(), $quote->getAmount());
        $this->assertNotEquals($previousQuote->getCost(), $quote->getCost());
        $this->assertNotEquals($previousQuote->getReference(), $quote->getReference());
        $this->assertEquals($previousQuote->getPercentage(), $quote->getPercentage());
    }
}
