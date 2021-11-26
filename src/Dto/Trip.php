<?php

declare(strict_types=1);

namespace App\Dto;

class Trip
{
    /**
     * @param string $from
     * @param string $to
     */
    public function __construct(
        private string $from,
        private string $to,
    ) {
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }
}
