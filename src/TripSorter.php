<?php

declare(strict_types=1);

namespace App;

use App\Dto\Baggage;
use App\Interfaces\DescriptionInterface;
use App\Interfaces\TicketInterface;

class TripSorter
{
    /**
     * @var TicketInterface[]
     */
    private array $tickets;

    /**
     * @var Baggage
     */
    private Baggage $baggage;

    /**
     * @param TicketInterface ...$tickets
     */
    public function addTickets(TicketInterface ...$tickets): void
    {
        $this->tickets = $tickets;
    }

    /**
     * @param Baggage $baggage
     */
    public function addBaggage(Baggage $baggage): void
    {
        $this->baggage = $baggage;
    }

    /**
     * @return string
     */
    public function getFullTripDescription(): string
    {
        $description = Description::create();

        /** @var TicketInterface|DescriptionInterface $ticket */
        foreach ($this->getSortedTickets() as $ticket) {
            $description->addDescriptionableItem($ticket);
        }
        $description->addDescriptionableItem($this->baggage, -1);

        return $description->getFullDescription();
    }

    /**
     * @return iterable
     */
    private function getSortedTickets(): iterable
    {
        $ticketMap = TicketMap::createFromTickets(...$this->tickets);

        while ($ticket = $ticketMap->getFirstTicket()) {
            $ticketMap->removeTicket($ticket);
            yield $ticket;
        }
    }
}
