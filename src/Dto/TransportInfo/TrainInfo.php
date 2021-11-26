<?php

declare(strict_types=1);

namespace App\Dto\TransportInfo;

use App\Interfaces\TransportInfoInterface;

class TrainInfo implements TransportInfoInterface
{
    /**
     * @param string $number
     * @param string $seat
     */
    public function __construct(
        private string $number,
        private string $seat,
    ) {
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }
}
