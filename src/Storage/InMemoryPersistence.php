<?php

namespace Hotel\Storage;


class InMemoryPersistence implements Persistence
{

    private $data = [];

    private $lastId = 0;

    public function generateId()
    {
        $this->lastId++;

        return $this->lastId;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function persist($data)
    {
        return $this->data[$this->lastId] = $data;
    }

    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new \OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        return $this->data[$id];
    }

    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new \OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        unset($this->data[$id]);
    }
}