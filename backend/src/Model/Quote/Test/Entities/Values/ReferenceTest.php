<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\Entities\Values;

use App\Model\Quote\Entities\Values\Reference;
use PHPUnit\Framework\TestCase;

class ReferenceTest extends TestCase
{
    public function testString(): void
    {
        $value = new Reference($param = 'Any str');

        $this->assertEquals($value->getValue(), $param);
    }

    public function testEmptyString(): void
    {
        $value = new Reference('');
        $this->assertNull($value->getValue());

        $value = new Reference('   ');
        $this->assertNull($value->getValue());
    }

    public function testNull(): void
    {
        $value = new Reference();

        $this->assertNull($value->getValue());
    }
}
