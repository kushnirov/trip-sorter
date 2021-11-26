<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Dto\TransportInfo\TrainInfo;

class TrainTicket extends AbstractTicket
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        /** @var TrainInfo $trainInfo */
        $trainInfo = $this->getTransportInfo();

        return strtr(
            'Take train [trainNumber] from [locationFrom] to [locationTo]. Sit in seat [seatNumber].',
            [
                '[locationFrom]' => $this->getTrip()->getFrom(),
                '[locationTo]' => $this->getTrip()->getTo(),
                '[trainNumber]' => $trainInfo->getNumber(),
                '[seatNumber]' => $trainInfo->getSeat(),
            ]
        );
    }
}
