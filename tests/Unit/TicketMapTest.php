<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Dto\Trip;
use App\Ticket\TrainTicket;
use App\TicketMap;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TicketMapTest extends TestCase
{
    /**
     * @var TicketMap
     */
    private TicketMap $ticketMap;

    /**
     * @var TrainTicket|MockObject
     */
    private TrainTicket|MockObject $ticketMock;

    /**
     * @var Trip|MockObject
     */
    private Trip|MockObject $tripMock;

    public function setUp(): void
    {
        $this->tripMock = $this->createConfiguredMock(Trip::class, [
            'getFrom' => 'some location from',
            'getTo' => 'some location to',
        ]);
        $this->ticketMock = $this->createConfiguredMock(TrainTicket::class, [
            'getTrip' => $this->tripMock,
        ]);
        $this->ticketMap = TicketMap::createFromTickets($this->ticketMock);
    }

    public function tearDown(): void
    {
        unset(
            $this->tripMock,
            $this->ticketMock,
            $this->ticketMap,
        );
    }

    public function testGetFirstTicket(): void
    {
        $ticket = $this->ticketMap->getFirstTicket();
        $this->assertSame($ticket, $this->ticketMock);
    }

    public function testRemoveTicket(): void
    {
        $this->ticketMap->removeTicket($this->ticketMock);

        $ticket = $this->ticketMap->getFirstTicket();
        $this->assertNull($ticket);
    }
}
