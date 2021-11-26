<?php

declare(strict_types=1);

namespace App;

use App\Interfaces\DescriptionInterface;

class Description
{
    /**
     * @param array $description
     */
    private function __construct(private array $description)
    {
        $this->setDescriptionStart();
    }

    /**
     * @param array $description
     * @return $this
     */
    public static function create(array $description = []): self
    {
        return new self($description);
    }

    /**
     * @param DescriptionInterface $item
     * @param int|null $offset
     */
    public function addDescriptionableItem(
        DescriptionInterface $item,
        ?int $offset = null,
    ): void {
        if ($offset === null) {
            $this->description[] = $item->getDescription();
        } else {
            array_splice($this->description, $offset, 0, $item->getDescription());
        }
    }

    /**
     * @return string
     */
    public function getFullDescription(): string
    {
        $this->setDescriptionEnd();

        return join(' ', $this->description) . PHP_EOL;
    }

    /**
     * @return void
     */
    private function setDescriptionStart(): void
    {
        $this->description = [];
    }

    /*
     * @retrun void
     */
    private function setDescriptionEnd(): void
    {
        $this->description[] = 'Baggage will be automatically transferred from your last leg.';
        $this->description[] = 'You have arrived at your final destination.';
    }
}
