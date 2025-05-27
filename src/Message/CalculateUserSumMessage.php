<?php

namespace App\Message;

final readonly class CalculateUserSumMessage
{
    public function __construct(
        private int $number,
    )
    {
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
