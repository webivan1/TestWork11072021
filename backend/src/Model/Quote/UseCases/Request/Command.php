<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Request;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    #[Assert\Positive]
    public ?int $id = null;

    #[Assert\Length(max: 150)]
    public ?string $task = null;

    #[Assert\Positive]
    public int $currentPage = 1;
}
