<?php

namespace Hotel\Repository;


use Hotel\Model\RoomDetail;
use Hotel\Storage\Persistence;

class RoomDetailRepository
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

    public function all()
    {
        return $this->persistence->all();
    }

    /**
     * @param int $id
     *
     * @return \Hotel\Model\RoomDetail
     */
    public function findById($id): ?RoomDetail
    {
        try {
            /** @var RoomDetail $data */
            $data = $this->persistence->retrieve($id);
        } catch (\OutOfBoundsException $e) {
            return null;
        }

        return $data;
    }

    /**
     * @param int $roomId
     *
     * @return array|RoomDetail[]
     */
    public function findAllByRoomId($roomId): array
    {
        $rows = $this->persistence->all();
        $result = [];

        /** @var RoomDetail $row */
        foreach ($rows as $row) {
            if ($row->getRoom()->getId() == $roomId) {
                $result[] = $row;
            }
        }

        return $result;
    }

    public function save(RoomDetail $roomDetail)
    {
        return $this->persistence->persist($roomDetail);
    }
}