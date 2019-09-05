<?php
namespace Reservator\DataBean;

class BeanSchedule
{
    private $startDate;
    private $endDate;
    private $hasReservation;
    private $numberOfPeople;

    /**
     * @return mixed
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getHasReservation(): bool
    {
        return $this->hasReservation;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPeople(): int
    {
        return $this->numberOfPeople;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @param mixed $hasReservation
     */
    public function setHasReservation(bool $hasReservation)
    {
        $this->hasReservation = $hasReservation;
    }

    /**
     * @param mixed $numberOfPeople
     */
    public function setNumberOfPeople(int $numberOfPeople)
    {
        $this->numberOfPeople = $numberOfPeople;
    }
}
