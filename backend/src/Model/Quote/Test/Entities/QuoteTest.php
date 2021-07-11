<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\Entities;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\Entities\Values\Amount;
use App\Model\Quote\Entities\Values\Percentage;
use App\Model\Quote\Entities\Values\Reference;
use App\Model\Quote\Entities\Values\Task;
use PHPUnit\Framework\TestCase;

class QuoteTest extends TestCase
{
    public function testCreate()
    {
        $quote = Quote::create(
            $task = new Task('New task'),
            $amount = new Amount(567.35),
            $percentage = new Percentage(28),
            $reference = new Reference('Some reference...')
        );

        $this->assertEquals($quote->getTask(), $task->getValue());
        $this->assertEquals($quote->getAmount(), $amount->getValue());
        $this->assertEquals($quote->getPercentage(), $percentage->getValue());
        $this->assertEquals($quote->getReference(), $reference->getValue());
        $this->assertEquals($quote->getCost(), Quote::calculateCost($amount->getValue(), $percentage->getValue()));
    }

    public function testUpdate()
    {
        $quote = Quote::create(
            new Task('Task'),
            new Amount(1000),
            new Percentage(0),
            new Reference()
        );

        $quote->update(
            $task = new Task('Task updated'),
            $amount = new Amount(35679.34),
            $percentage = new Percentage(50),
            $reference = new Reference('Some reference...')
        );

        $this->assertEquals($quote->getTask(), $task->getValue());
        $this->assertEquals($quote->getAmount(), $amount->getValue());
        $this->assertEquals($quote->getPercentage(), $percentage->getValue());
        $this->assertEquals($quote->getReference(), $reference->getValue());
        $this->assertEquals($quote->getCost(), Quote::calculateCost($amount->getValue(), $percentage->getValue()));
    }
}
