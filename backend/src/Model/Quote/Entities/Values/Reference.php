<?php

declare(strict_types=1);

namespace App\Model\Quote\Entities\Values;

use App\Model\Quote\Contracts\ValueContract;

class Reference implements ValueContract
{
    private ?string $value = null;

    public function __construct(?string $value = null)
    {
        if ($value) {
            $value = trim($value);
            $this->value = empty($value) ? null : $value;
        }
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
