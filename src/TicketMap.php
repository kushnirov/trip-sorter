<?php

declare(strict_types=1);

namespace App;

use App\Interfaces\TicketInterface;

class TicketMap
{
    /**
     * @var array
     */
    private $from;

    /**
     * @var array
     */
    private $to;

    /**
     * @param TicketInterface[] $tickets
     */
    private function __construct(private array $tickets)
    {
        $this->splitTickets();
    }

    /**
     * @param TicketInterface ...$tickets
     * @return static
     */
    public static function createFromTickets(TicketInterface ...$tickets): self
    {
        return new self($tickets);
    }

    /**
     * @return TicketInterface|null
     */
    public function getFirstTicket(): ?TicketInterface
    {
        return current(array_diff_key($this->from, $this->to)) ?: null;
    }

    /**
     * @param TicketInterface $ticket
     */
    public function removeTicket(TicketInterface $ticket): void
    {
        unset(
            $this->from[$ticket->getTrip()->getFrom()],
            $this->to[$ticket->getTrip()->getTo()]
        );
    }

    /**
     * @return void
     */
    private function splitTickets(): void
    {
        foreach ($this->tickets as $ticket) {
            $this->from[$ticket->getTrip()->getFrom()] = $ticket;
            $this->to[$ticket->getTrip()->getTo()] = $ticket;
        }
    }
}
