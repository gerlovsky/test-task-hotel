<?php

namespace Hotel\Service\Exception;


use DateTime;

class FailureRoomReservationException extends \Exception
{
    public static function reserved($roomId, DateTime $checkIn, DateTime $checkOut)
    {
        return new static(
            sprintf(
                'Room #%d is busy at %s - %s. Please try another Option!',
                $roomId,
                $checkIn->format('Y-m-d H:i:s'),
                $checkOut->format('Y-m-d H:i:s')
            )
        );
    }

    public static function noAvailable()
    {
        return new static('Sorry Rooms Are not Available. Please try another Option!');
    }
}