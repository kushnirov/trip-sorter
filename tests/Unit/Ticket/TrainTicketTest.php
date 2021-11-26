<?php

declare(strict_types=1);

namespace Tests\Unit\Ticket;

use App\Dto\TransportInfo\TrainInfo;
use App\Dto\Trip;
use App\Ticket\TrainTicket;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TrainTicketTest extends TestCase
{
    /**
     * @var TrainTicket
     */
    private TrainTicket $trainTicket;

    /**
     * @var Trip|MockObject
     */
    private Trip|MockObject $tripMock;

    /**
     * @var TrainInfo|MockObject
     */
    private TrainInfo|MockObject $trainInfoMock;

    public function setUp(): void
    {
        $this->tripMock = $this->createConfiguredMock(Trip::class, [
            'getFrom' => 'some location from',
            'getTo' => 'some location to',
        ]);
        $this->trainInfoMock = $this->createConfiguredMock(TrainInfo::class, [
            'getNumber' => '1A',
            'getSeat' => '2B',
        ]);
        $this->trainTicket = new TrainTicket($this->tripMock, $this->trainInfoMock);
    }

    public function tearDown(): void
    {
        unset(
            $this->tripMock,
            $this->trainInfoMock,
            $this->trainTicket,
        );
    }

    public function testGetTrip(): void
    {
        $this->assertSame($this->trainTicket->getTrip(), $this->tripMock);
    }

    public function testGetTransportInfo(): void
    {
        $this->assertSame($this->trainTicket->getTransportInfo(), $this->trainInfoMock);
    }

    public function testGetDescription(): void
    {
        $result =$this->trainTicket->getDescription();

        $this->assertSame(
            $result,
            strtr(
                'Take train [trainNumber] from [locationFrom] to [locationTo]. Sit in seat [seatNumber].',
                [
                    '[locationFrom]' => $this->tripMock->getFrom(),
                    '[locationTo]' => $this->tripMock->getTo(),
                    '[trainNumber]' => $this->trainInfoMock->getNumber(),
                    '[seatNumber]' => $this->trainInfoMock->getSeat(),
                ]
            )
        );
    }
}
