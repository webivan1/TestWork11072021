<?php

declare(strict_types=1);

namespace App\Model\Quote\Entities\Values;

use App\Model\Quote\Contracts\ValueContract;

class Amount implements ValueContract
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
