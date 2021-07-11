<?php

declare(strict_types=1);

namespace App\Model\Quote\Contracts;

interface ValueContract
{
    public function getValue(): mixed;
}
