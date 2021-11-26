<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Dto\TransportInfo\AirplaneInfo;

class AirplaneTicket extends AbstractTicket
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        /** @var AirplaneInfo $airplaneInfo */
        $airplaneInfo = $this->getTransportInfo();

        return strtr(
            'From [locationFrom], take flight [flightNumber] to [locationTo]. Gate [gateNumber], seat [seatNumber].',
            [
                '[locationFrom]' => $this->getTrip()->getFrom(),
                '[locationTo]' => $this->getTrip()->getTo(),
                '[flightNumber]' => $airplaneInfo->getFlight(),
                '[gateNumber]' => $airplaneInfo->getGate(),
                '[seatNumber]' => $airplaneInfo->getSeat(),
            ]
        );
    }
}
