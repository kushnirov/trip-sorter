<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\TripSorter;
use App\Ticket\TrainTicket;
use App\Ticket\BusTicket;
use App\Ticket\AirplaneTicket;
use App\Dto\Trip;
use App\Dto\TransportInfo\TrainInfo;
use App\Dto\TransportInfo\AirplaneInfo;
use App\Dto\Baggage;

$tripSorter = new TripSorter();

$tripSorter->addTickets(
    new BusTicket(new Trip('Barcelona', 'Gerona Airport')),
    new AirplaneTicket(new Trip('Stockholm', 'New York JFK'), new AirplaneInfo('SK22', '22', '7B')),
    new TrainTicket(new Trip('Madrid', 'Barcelona'), new TrainInfo('78A', '45B')),
    new AirplaneTicket(new Trip('Gerona Airport', 'Stockholm'), new AirplaneInfo('SK455', '45B', '3A')),
);
$tripSorter->addBaggage(new Baggage(344));

echo $tripSorter->getFullTripDescription();
