<?php

declare(strict_types=1);

namespace App\Dto;

use App\Interfaces\DescriptionInterface;

class Baggage implements DescriptionInterface
{
    /**
     * @param int $ticketCounter
     */
    public function __construct(private int $ticketCounter)
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return strtr(
            'Baggage drop at ticket counter [ticketCounter].',
            [
                '[ticketCounter]' => $this->ticketCounter,
            ]
        );
    }
}
