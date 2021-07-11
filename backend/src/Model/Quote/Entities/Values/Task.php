<?php

declare(strict_types=1);

namespace App\Model\Quote\Entities\Values;

use App\Model\Quote\Contracts\ValueContract;
use Webmozart\Assert\Assert;

class Task implements ValueContract
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        Assert::notEmpty($value);
        Assert::maxLength($value, 150);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
