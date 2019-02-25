<?php

use Hotel\Model\Room;
use Hotel\Model\RoomDetail;
use Hotel\Model\User;
use Hotel\Repository\RoomDetailRepository;
use Hotel\Repository\RoomRepository;
use Hotel\Service\RoomReservationService;
use Hotel\Storage\InMemoryPersistence;

$roomRepository = new RoomRepository(
    new InMemoryPersistence()
);

$detailRoomRepository = new RoomDetailRepository(
    new InMemoryPersistence()
);

$roomList = [
    new Room(201, 'Garden view', 100, 2),
    new Room(202, 'Garden view', 200, 2),
    new Room(203, 'Street view', 45, 1),
    new Room(204, 'Street view', 90, 1),
    new Room(205, 'Ocean view', 250, 2),
    new Room(206, 'Ocean view', 300, 2),
];

foreach ($roomList as $row) {
    $roomRepository->generateId();
    $roomRepository->save($row);
}

$randomUsername = [
    'apollowabbit',
    'pardigglelucid',
    'maggotundertake',
    'matanetidbit',
    'annabelleugliest',
    'seedwine',
    'laidgroup',
    'cheekpillar',
];

$roomDetailIndex = 0;


// Get IDs of rooms
$roomIds = array_map(
    function (Room $room) {
        return $room->getId();
    },
    $roomList
);

// Fill random records
while ($roomDetailIndex++ < 5) {

    $userIndex = array_rand($randomUsername, 1);
    $user = new User($randomUsername[$userIndex]);

    $checkIn = (new DateTime('2018-11-04 00:00:00'))
        ->add(new DateInterval('P'.($roomDetailIndex).'D'));

    $checkOut = (new DateTime('2018-11-04 23:59:59'))
        ->add(new DateInterval('P'.($roomDetailIndex + 2).'D'));

    $numOfPlaces = rand(1, 5);
    $amount = rand(0, 9999);

    $roomIndex = (count($roomIds)+$roomDetailIndex) % 6;

    $detailRoomRepository->save(
        new RoomDetail(
            $detailRoomRepository->generateId(),
            $user,
            $checkIn,
            $checkOut,
            $roomList[$roomIndex],
            $numOfPlaces,
            $amount
        )
    );
}

// Service for reservation rooms
$roomReservationService = new RoomReservationService(
    $roomRepository,
    $detailRoomRepository
);

function printSuccessReservation(RoomDetail $roomDetail)
{
    echo sprintf(
        '<p>Reservation success #%d 
                <br>Room ID: %d
                <br>Room Type: %s
                <br>Check in: %s
                <br>Check out: %s
                <br>Number of places: %d
                <br>Total: %d
                </p><hr>',
        $roomDetail->getId(),
        $roomDetail->getRoom()->getId(),
        $roomDetail->getRoom()->getType(),
        $roomDetail->getCheckIn()->format('Y-m-d H:i:s'),
        $roomDetail->getCheckOut()->format('Y-m-d H:i:s'),
        $roomDetail->getNumberOfPlaces(),
        $roomDetail->getTotal()
    );
}

/**
 * @param array|RoomDetail[] $roomDetails
 */
function printAllReservation(array $roomDetails)
{
    echo '<table><thead>
            <td>ID</td>
            <td>User</td>
            <td>Room</td>
            <td>Room type</td>
            <td>Check in</td>
            <td>Check out</td>
            <td>Number of places</td>
            <td>Total</td>
        </thead>';

    foreach ($roomDetails as $roomDetail) {
        echo sprintf(
            '<tbody><tr>
            <td>%d</td>
            <td>%s</td>
            <td>%d</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%d</td>
        </tr></tbody>',
            $roomDetail->getId(),
            $roomDetail->getUser(),
            $roomDetail->getRoom()->getId(),
            $roomDetail->getRoom()->getType(),
            $roomDetail->getCheckIn()->format('Y-m-d H:i:s'),
            $roomDetail->getCheckOut()->format('Y-m-d H:i:s'),
            $roomDetail->getNumberOfPlaces(),
            $roomDetail->getTotal()
        );
    }

    echo '</table>';
}

