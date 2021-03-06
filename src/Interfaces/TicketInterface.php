<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Dto\Trip;

interface TicketInterface
{
    /**
     * @return Trip
     */
    public function getTrip(): Trip;

    /**
     * @return string
     */
    public function getDescription(): string;
}
