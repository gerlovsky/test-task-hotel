<?php

namespace Hotel\Repository\Exception;


class RoomNotFoundException extends \Exception
{
    /**
     *
     */
    public static function byId($roomId)
    {
        return new static('Room by #'.$roomId.' not found.');
    }
}