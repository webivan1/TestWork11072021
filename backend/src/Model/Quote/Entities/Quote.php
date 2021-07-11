<?php

declare(strict_types=1);

namespace App\Model\Quote\Entities;

use App\Model\Quote\Entities\Values\Amount;
use App\Model\Quote\Entities\Values\Percentage;
use App\Model\Quote\Entities\Values\Reference;
use App\Model\Quote\Entities\Values\Task;
use App\Model\Quote\Repositories\QuoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteRepository::class)
 */
class Quote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $task;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $reference = null;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private float $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private int $percentage;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private float $cost;

    public static function create(Task $task, Amount $amount, Percentage $percentage, Reference $reference): self
    {
        $model = new self;
        $model->task = $task->getValue();
        $model->amount = $amount->getValue();
        $model->percentage = $percentage->getValue();
        $model->reference = $reference->getValue();
        $model->cost = self::calculateCost($model->amount, $model->percentage);
        return $model;
    }

    public function update(Task $task, Amount $amount, Percentage $percentage, Reference $reference): void
    {
        $this->task = $task->getValue();
        $this->amount = $amount->getValue();
        $this->percentage = $percentage->getValue();
        $this->reference = $reference->getValue();
        $this->cost = self::calculateCost($this->amount, $this->percentage);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public static function calculateCost(float $amount, int $percentage): float
    {
        if ($percentage <= 0) {
            return $amount;
        }

        return round($amount - ($amount * ($percentage / 100)), 2);
    }
}
