<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Dto\Baggage;
use App\Dto\Trip;
use App\Interfaces\TicketInterface;
use App\Ticket\TrainTicket;
use App\TripSorter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TripSorterTest extends TestCase
{
    /**
     * @var TripSorter
     */
    private TripSorter $tripSorter;

    /**
     * @var TicketInterface|MockObject
     */
    private TicketInterface|MockObject $ticketMock;

    /**
     * @var Baggage|MockObject
     */
    private Baggage|MockObject $baggageMock;

    /**
     * @var Trip|MockObject
     */
    private Trip|MockObject $tripMock;

    public function setUp(): void
    {
        $this->tripSorter = new TripSorter();
        $this->ticketMock = $this->createMock(TrainTicket::class);
        $this->baggageMock = $this->createMock(Baggage::class);
        $this->tripMock = $this->createMock(Trip::class);
    }

    public function tearDown(): void
    {
        unset(
            $this->tripSorter,
            $this->ticketMock,
        );
    }

    public function testGetFullTripDescriptionTicket(): void
    {
        $this->tripMock
            ->expects($this->any())
            ->method('getFrom')
            ->willReturn('some location from');

        $this->tripMock
            ->expects($this->any())
            ->method('getTo')
            ->willReturn('some location to');

        $this->ticketMock
            ->expects($this->any())
            ->method('getTrip')
            ->willReturn($this->tripMock);

        $this->ticketMock
            ->expects($this->once())
            ->method('getDescription')
            ->willReturn('dummy ticket description');

        $this->tripSorter->addTickets($this->ticketMock);
        $this->tripSorter->addBaggage($this->baggageMock);
        $result = $this->tripSorter->getFullTripDescription();

        $this->assertStringContainsString('dummy ticket description', $result);
    }

    public function testGetFullTripDescriptionBaggage(): void
    {
        $this->baggageMock
            ->expects($this->once())
            ->method('getDescription')
            ->willReturn('some baggage description');

        $this->tripSorter->addTickets($this->ticketMock);
        $this->tripSorter->addBaggage($this->baggageMock);
        $result = $this->tripSorter->getFullTripDescription();

        $this->assertStringContainsString('some baggage description', $result);
    }
}
