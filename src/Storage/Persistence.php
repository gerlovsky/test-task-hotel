<?php

namespace Hotel\Storage;


interface Persistence
{
    /**
     * @return mixed
     */
    public function generateId();

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param mixed $data
     */
    public function persist($data);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function retrieve(int $id);

    /**
     * @param int $id
     */
    public function delete(int $id);
}