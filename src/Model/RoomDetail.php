<?php

namespace Hotel\Model;


use DateTime;

class RoomDetail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var \DateTime
     */
    private $checkIn;

    /**
     * @var \DateTime
     */
    private $checkOut;

    /**
     * @var int
     */
    private $room;

    /**
     * @var int
     */
    private $numberOfPlaces;

    /**
     * @var float
     */
    private $total;

    /**
     * RoomDetail constructor.
     *
     * @param $id
     * @param User $user
     * @param \DateTime $checkIn
     * @param \DateTime $checkOut
     * @param \Hotel\Model\Room $room
     * @param int $numberOfPlaces
     * @param float $total
     *
     * @internal param int $roomId
     */
    public function __construct(
        $id,
        User $user,
        DateTime $checkIn,
        DateTime $checkOut,
        Room $room,
        $numberOfPlaces,
        $total
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->room = $room;
        $this->numberOfPlaces = $numberOfPlaces;
        $this->total = $total;
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
     * @return RoomDetail
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return RoomDetail
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCheckIn(): DateTime
    {
        return $this->checkIn;
    }

    /**
     * @param \DateTime $checkIn
     *
     * @return RoomDetail
     */
    public function setCheckIn(DateTime $checkIn)
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCheckOut(): DateTime
    {
        return $this->checkOut;
    }

    /**
     * @param \DateTime $checkOut
     *
     * @return RoomDetail
     */
    public function setCheckOut(DateTime $checkOut)
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    /**
     * @return \Hotel\Model\Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param \Hotel\Model\Room $room
     *
     * @return RoomDetail
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;

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
     * @return RoomDetail
     */
    public function setNumberOfPlaces(int $numberOfPlaces)
    {
        $this->numberOfPlaces = $numberOfPlaces;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     *
     * @return RoomDetail
     */
    public function setTotal(float $total)
    {
        $this->total = $total;

        return $this;
    }
}