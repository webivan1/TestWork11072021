<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\Entities\Values;

use App\Model\Quote\Entities\Values\Percentage;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class PercentageTest extends TestCase
{
    public function testValid(): void
    {
        foreach ([0, 23, 1, 99, 55] as $param) {
            $value = new Percentage($param);
            $this->assertEquals($value->getValue(), $param);
        }
    }

    public function testLessThanZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Percentage(-1);
    }
}
