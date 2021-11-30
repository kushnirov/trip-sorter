<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Dto\Trip;
use App\Interfaces\DescriptionInterface;
use App\Interfaces\TicketInterface;

class BusTicket implements TicketInterface, DescriptionInterface
{
    /**
     * @param Trip $trip
     */
    public function __construct(private Trip $trip)
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return strtr(
            'Take the airport bus from [locationFrom] to [locationTo]. No seat assignment.',
            [
                '[locationFrom]' => $this->trip->getFrom(),
                '[locationTo]' => $this->trip->getTo(),
            ]
        );
    }

    /**
     * @return Trip
     */
    public function getTrip(): Trip
    {
        return $this->trip;
    }
}
