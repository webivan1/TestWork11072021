<?php

declare(strict_types=1);

namespace App\Model\Quote\Test\Entities\Values;

use App\Model\Quote\Entities\Values\Task;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class TaskTest extends TestCase
{
    public function testString(): void
    {
        $value = new Task($param = 'Task');
        $this->assertEquals($value->getValue(), $param);

        $value = new Task($param = str_repeat('tests', 30));
        $this->assertEquals($value->getValue(), $param);
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Task('');
    }

    public function testMaxLength(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Task(str_repeat('tests', 30) . '1');
    }
}
