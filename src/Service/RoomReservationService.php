<?php

namespace Hotel\Service;

use DateTime;
use Hotel\Model\Room;
use Hotel\Model\RoomDetail;
use Hotel\Repository\RoomDetailRepository;
use Hotel\Repository\RoomRepository;
use Hotel\Service\Exception\FailureRoomReservationException;

class RoomReservationService
{
    /**
     * @var \Hotel\Repository\RoomRepository
     */
    private $roomRepository;

    /**
     * @var \Hotel\Repository\RoomDetailRepository
     */
    private $detailRepository;

    /**
     * RoomReservationService constructor.
     *
     * @param \Hotel\Repository\RoomRepository $roomRepository
     * @param \Hotel\Repository\RoomDetailRepository $detailRepository
     */
    public function __construct(
        RoomRepository $roomRepository,
        RoomDetailRepository $detailRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->detailRepository = $detailRepository;
    }

    /**
     * RoomDetail constructor.
     *
     * @param $user \Hotel\Model\User Reservation by user
     * @param $checkIn \DateTime Checkin Date
     * @param $checkOut \DateTime Checkout date
     * @param $room Room Room
     * @param $numberOfPlaces int Number of places
     * @param float|int $amount Amount
     *
     * @return \Hotel\Model\RoomDetail
     * @throws \Hotel\Service\Exception\FailureRoomReservationException
     */
    public function reservation(
        $user,
        $checkIn,
        $checkOut,
        $room,
        $numberOfPlaces,
        $amount = 0
    ) {
        $this->checkAvailableRoomBy($room, $checkIn, $checkOut);

        // Check custom amount
        if ($amount > 0) {
            $total = $amount;
        } else {
            // Calculate total price
            $total = $room->getPrice() * $numberOfPlaces;
        }

        return $this->detailRepository->save(
            new RoomDetail(
                $this->detailRepository->generateId(),
                $user,
                $checkIn,
                $checkOut,
                $room,
                $numberOfPlaces,
                $total
            )
        );
    }

    /**
     * Check the date in the date range
     *
     * @param DateTime $start_date
     * @param DateTime $end_date
     * @param DateTime $date_from_user
     *
     * @return bool
     */
    protected function checkDateTimeInRange($start_date, $end_date, $date_from_user)
    {
        return (($date_from_user >= $start_date) && ($date_from_user <= $end_date));
    }

    /**
     * Check available room by parameters
     *
     * @param \Hotel\Model\Room $room
     * @param \DateTime $checkIn
     * @param \DateTime $checkOut
     *
     * @return bool
     * @throws \Hotel\Service\Exception\FailureRoomReservationException
     */
    public function checkAvailableRoomBy(Room $room, DateTime $checkIn, DateTime $checkOut)
    {
        if ($roomDetails = $this->detailRepository->findAllByRoomId($room->getId())) {
            foreach ($roomDetails as $key => $roomDetail) {
                if (
                    $room->getId() == $roomDetail->getRoom()->getId()
                    && (
                        $this->checkDateTimeInRange($roomDetail->getCheckIn(), $roomDetail->getCheckOut(), $checkIn)
                        || $this->checkDateTimeInRange($roomDetail->getCheckIn(), $roomDetail->getCheckOut(), $checkOut)
                    )
                ) {
                    throw FailureRoomReservationException::reserved(
                        $room->getId(),
                        $checkIn,
                        $checkOut
                    );
                }
            }
        }

        return true;
    }
}