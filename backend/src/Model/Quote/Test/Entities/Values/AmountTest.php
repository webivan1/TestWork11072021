<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\Entities\Values;

use App\Model\Quote\Entities\Values\Amount;
use PHPUnit\Framework\TestCase;

class AmountTest extends TestCase
{
    public function testSuccess(): void
    {
        $value = new Amount($param = 1564.34);

        $this->assertEquals($value->getValue(), $param);
    }
}
