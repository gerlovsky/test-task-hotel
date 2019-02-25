<?php

use Hotel\Model\User;
use Hotel\Repository\RoomDetailRepository;
use Hotel\Service\Exception\FailureRoomReservationException;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/bootstrap.php';

/** @var RoomDetailRepository $detailRoomRepository */

try {
    // User, who reserved room
    $user = new User('John');

    $room = $roomRepository->findById(203);

    //
    // -== Next reserve ==-
    //

    $checkIn = new DateTime('2018-11-01 00:00:00');
    $checkOut = new DateTime('2018-11-04 23:59:59');

    // Room reservation
    if ($roomReservationService->checkAvailableRoomBy($room, $checkIn, $checkOut)) {
        $roomReservation1 = $roomReservationService->reservation($user, $checkIn, $checkOut, $room, 2, 500);
        printSuccessReservation($roomReservation1);
    }

    //
    // -== Next reserve ==-
    //

    $checkIn = new DateTime('2018-11-03 00:00:00');
    $checkOut = new DateTime('2018-11-09 23:59:59');

    // Room reservation
    // Must throw an exception. Because it is already reserved for this date
    if ($roomReservationService->checkAvailableRoomBy($room, $checkIn, $checkOut)) {
        $roomReservation2 = $roomReservationService->reservation($user, $checkIn, $checkOut, $room, 1, 1500);
        printSuccessReservation($roomReservation2);
    }

} catch (FailureRoomReservationException $e) {
    echo 'Failure room reservation: '.$e->getMessage().'<hr>';
}

echo '<h2>List reserved rooms</h2>';

// Print all reserve
printAllReservation($detailRoomRepository->all());