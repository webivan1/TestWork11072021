<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\UseCases\Create;

use App\Model\Quote\UseCases\Create\Command;
use App\Model\Quote\UseCases\Create\Handler;
use App\Tests\DatabaseWebTest;
use Webmozart\Assert\InvalidArgumentException;

class HandlerTest extends DatabaseWebTest
{
    public function testSuccess()
    {
        /** @var Handler $handler */
        $handler = $this->getContainer()->get(Handler::class);
        $command = new Command();
        $command->task = 'Task test';
        $command->amount = 45.78;
        $command->percentage = 0;
        $model = $handler->create($command);

        $this->assertTrue($model->getId() > 0);
        $this->assertEquals($model->getTask(), $command->task);
        $this->assertEquals($model->getAmount(), $command->amount);
        $this->assertEquals($model->getPercentage(), $command->percentage);
        $this->assertNull($model->getReference());
        $this->assertEquals($model->getCost(), $command->amount);
    }

    public function testFail()
    {
        $this->expectException(InvalidArgumentException::class);

        /** @var Handler $handler */
        $handler = $this->getContainer()->get(Handler::class);
        $command = new Command();
        $command->task = '';
        $command->amount = -45.78;
        $command->percentage = 120;
        $handler->create($command);
    }
}
