<?php

declare(strict_types=1);

namespace App\Ticket;

class BusTicket extends AbstractTicket
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return strtr(
            'Take the airport bus from [locationFrom] to [locationTo]. No seat assignment.',
            [
                '[locationFrom]' => $this->getTrip()->getFrom(),
                '[locationTo]' => $this->getTrip()->getTo(),
            ]
        );
    }
}
