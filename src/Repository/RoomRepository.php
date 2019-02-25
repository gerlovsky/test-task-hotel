<?php

namespace Hotel\Repository;


use Hotel\Model\Room;
use Hotel\Storage\Persistence;

class RoomRepository
{
    /**
     * @var \Hotel\Storage\Persistence
     */
    private $persistence;

    /**
     * RoomDetailRepository constructor.
     *
     * @param \Hotel\Storage\Persistence $persistence
     */
    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }

    public function generateId(): int
    {
        return $this->persistence->generateId();
    }

    /**
     * @param int $id
     *
     * @return \Hotel\Model\Room
     */
    public function findById($id): Room
    {
        $rows = $this->persistence->all();

        /** @var Room $row */
        foreach ($rows as $row) {
            if ($row->getId() == $id) {
                return $row;
            }
        }

        throw new \OutOfBoundsException(sprintf('Room with id %d does not exists', $id));
    }

    public function save(Room $room)
    {
        return $this->persistence->persist($room);
    }
}