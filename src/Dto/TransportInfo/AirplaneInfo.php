<?php

declare(strict_types=1);

namespace App\Dto\TransportInfo;

use App\Interfaces\TransportInfoInterface;

class AirplaneInfo implements TransportInfoInterface
{
    /**
     * @param string $flight
     * @param string $gate
     * @param string $seat
     */
    public function __construct(
        private string $flight,
        private string $gate,
        private string $seat,
    ) {
    }

    /**
     * @return string
     */
    public function getFlight(): string
    {
        return $this->flight;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }
}
