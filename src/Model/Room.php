<?php

namespace Hotel\Model;

class Room
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $numberOfPlaces;

    /**
     * @var float
     */
    protected $price;

    /**
     * RoomType constructor.
     *
     * @param int $id
     * @param string $type
     * @param float $price
     * @param int $numberOfPlaces
     */
    public function __construct($id, $type, $price, $numberOfPlaces)
    {
        $this->id = $id;
        $this->type = $type;
        $this->price = $price;
        $this->numberOfPlaces = $numberOfPlaces;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Room
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Room
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfPlaces(): int
    {
        return $this->numberOfPlaces;
    }

    /**
     * @param int $numberOfPlaces
     *
     * @return Room
     */
    public function setNumberOfPlaces(int $numberOfPlaces)
    {
        $this->numberOfPlaces = $numberOfPlaces;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return Room
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }
}