<?php

class Seat
{
    const MIN_SEAT_NUMBER = 1;
    const MAX_SEAT_NUMBER = 60;
    const MIN_SEAT_SECTION = "A";
    const MAX_SEAT_SECTION = "K";
    const UNUSED_CHARS = ["I", "J"];
    const ERROR_MESSAGE = "No Seat!!";

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $section;

    /**
     * @param $number
     */
    public function setNumber($number)
    {
        if (!is_int($number) || $number < self::MIN_SEAT_NUMBER || $number > self::MAX_SEAT_NUMBER) {
            throw new InvalidArgumentException(self::ERROR_MESSAGE);
        }

        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param $section
     */
    public function setSection($section)
    {
        if (!is_string($section) || $section < self::MIN_SEAT_SECTION || $section > self::MAX_SEAT_SECTION || in_array($section, self::UNUSED_CHARS)) {
            throw new InvalidArgumentException(self::ERROR_MESSAGE);
        }

        $this->section = $section;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }
}

class SeatParser
{
    /**
     * @param string $seat
     * @return Seat
     */
    public function parse(string $seat): Seat
    {
        $number = (int)$seat;
        $section = $seat[strlen($seat) - 1];

        $seat = new Seat();
        $seat->setNumber($number);
        $seat->setSection($section);

        return $seat;
    }
}

class SeatLocator
{
    /**
     * @param Seat $seat
     * @return string
     */
    public function getLocation(Seat $seat): string
    {
        return $this->getLocationBySeatNumber($seat->getNumber()) . "-" . $this->getLocationBySeatSection($seat->getSection());
    }

    /**
     * @param int $number
     * @return string
     */
    private function getLocationBySeatNumber(int $number): string
    {
        if ($this->isFrontSeatNumber($number)) {
            $result = "Front";
        } else if ($this->isMiddleSeatNumber($number)) {
            $result = "Middle";
        } else if ($this->isBackSeatNumber($number)) {
            $result = "Back";
        }

        return $result;
    }

    /**
     * @param string $section
     * @return string
     */
    private function getLocationBySeatSection(string $section): string
    {
        if ($this->isLeftSeatSection($section)) {
            $result = "Left";
        } else if ($this->isMiddleSeatSection($section)) {
            $result = "Middle";
        } else if ($this->isFrontRightSection($section)) {
            $result = "Right";
        }

        return $result;
    }

    /**
     * @param $number
     * @return bool
     */
    protected function isFrontSeatNumber($number)
    {
        return 1 <= $number && $number <= 20;
    }

    /**
     * @param $number
     * @return bool
     */
    protected function isMiddleSeatNumber($number)
    {
        return 21 <= $number && $number <= 40;
    }

    /**
     * @param $number
     * @return bool
     */
    protected function isBackSeatNumber($number)
    {
        return 41 <= $number && $number <= 60;
    }

    /**
     * @param $section
     * @return bool
     */
    protected function isLeftSeatSection($section)
    {
        return "A" <= $section && $section <= "C";
    }

    /**
     * @param $section
     * @return bool
     */
    protected function isMiddleSeatSection($section)
    {
        return "D" <= $section && $section <= "F";
    }

    /**
     * @param $section
     * @return bool
     */
    protected function isFrontRightSection($section)
    {
        return "G" <= $section && $section <= "K";
    }
}


function planeSeat($a){
    $seatParser = new SeatParser();

    try {
        $seat = $seatParser->parse($a);
    } catch (InvalidArgumentException $e) {
        return $e->getMessage();
    }

    $seatLocator = new SeatLocator();

    $result = $seatLocator->getLocation($seat);

    return $result;
}
