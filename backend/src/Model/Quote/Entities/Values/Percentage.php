<?php

declare(strict_types=1);

namespace App\Model\Quote\Entities\Values;

use App\Model\Quote\Contracts\ValueContract;
use Webmozart\Assert\Assert;

class Percentage implements ValueContract
{
    private int $value;

    public function __construct(int $value)
    {
        Assert::greaterThanEq($value, 0);
        Assert::lessThanEq($value, 100);

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
