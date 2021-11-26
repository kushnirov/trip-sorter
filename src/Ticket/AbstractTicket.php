<?php

declare(strict_types=1);

namespace App\Ticket;

use App\Interfaces\DescriptionInterface;
use App\Dto\Trip;
use App\Interfaces\TicketInterface;
use App\Interfaces\TransportInfoInterface;

abstract class AbstractTicket implements TicketInterface, DescriptionInterface
{
    /**
     * @param Trip $trip
     * @param TransportInfoInterface|null $transportInfo
     */
    public function __construct(
        private Trip $trip,
        private ?TransportInfoInterface $transportInfo = null,
    ) {
    }

    /**
     * @return Trip
     */
    public function getTrip(): Trip
    {
        return $this->trip;
    }

    /**
     * @return TransportInfoInterface|null
     */
    public function getTransportInfo(): ?TransportInfoInterface
    {
        return $this->transportInfo;
    }
}
