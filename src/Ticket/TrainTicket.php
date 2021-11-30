<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Dto\TransportInfo\TrainInfo;
use App\Dto\Trip;
use App\Interfaces\DescriptionInterface;
use App\Interfaces\TicketInterface;

class TrainTicket implements TicketInterface, DescriptionInterface
{
    /**
     * @param Trip $trip
     * @param TrainInfo $trainInfo
     */
    public function __construct(
        private Trip $trip,
        private TrainInfo $trainInfo
    ) {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return strtr(
            'Take train [trainNumber] from [locationFrom] to [locationTo]. Sit in seat [seatNumber].',
            [
                '[locationFrom]' => $this->trip->getFrom(),
                '[locationTo]' => $this->trip->getTo(),
                '[trainNumber]' => $this->trainInfo->getNumber(),
                '[seatNumber]' => $this->trainInfo->getSeat(),
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
