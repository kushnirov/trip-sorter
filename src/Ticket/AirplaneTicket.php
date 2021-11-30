<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Dto\TransportInfo\AirplaneInfo;
use App\Dto\Trip;
use App\Interfaces\DescriptionInterface;
use App\Interfaces\TicketInterface;

class AirplaneTicket implements TicketInterface, DescriptionInterface
{
    /**
     * @param Trip $trip
     * @param AirplaneInfo $airplaneInfo
     */
    public function __construct(
        private Trip $trip,
        private AirplaneInfo $airplaneInfo
    ) {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return strtr(
            'From [locationFrom], take flight [flightNumber] to [locationTo]. Gate [gateNumber], seat [seatNumber].',
            [
                '[locationFrom]' => $this->trip->getFrom(),
                '[locationTo]' => $this->trip->getTo(),
                '[flightNumber]' => $this->airplaneInfo->getFlight(),
                '[gateNumber]' => $this->airplaneInfo->getGate(),
                '[seatNumber]' => $this->airplaneInfo->getSeat(),
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
