<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Update;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    #[Assert\NotBlank()]
    #[Assert\Length(max: 150)]
    public string $task;

    #[Assert\NotBlank()]
    #[Assert\PositiveOrZero()]
    #[Assert\Type('float')]
    public float $amount;

    #[Assert\NotBlank()]
    #[Assert\Range(min: 0, max: 100)]
    public int $percentage;

    public ?string $reference = null;
}
