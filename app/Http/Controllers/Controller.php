<?php
namespace Reservator\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Reservator\Config\AppConfig;
use Reservator\Reservation;
use Reservator\Config\DBConfig;
use Reservator\Config\ShopConfig;
use Reservator\DataBean\BeanSchedule;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function getDataList ($targetDateString)
    {
        $targetDateStartString = $targetDateString . ' 00:00:00';
        $targetDateEndString = $targetDateString . ' 23:59:59';
        //DBから予約取得
        $query = Reservation::query();
        $query->where(Reservation::COLUMN_START_AT, DBConfig::MORE_THAN_EQUALS, $targetDateStartString);
        $query->where(Reservation::COLUMN_START_AT, DBConfig::LESS_THAN_EQUALS, $targetDateEndString);
        return $query->get();
    }

    public static function getScheduleBeanList ($dataList, $targetDateString)
    {
        $reservationList = array();
        if ($dataList != null) {
            foreach ($dataList as $reservation) {
                $dates = new \DateTime($reservation->getValue(Reservation::COLUMN_START_AT));
                $reservationDateString = $dates->format(AppConfig::FORMAT_DATE_TIME);
                $reservationList[$reservationDateString] = $reservation;
            }
        }
        $scheduleBeanList = array();
        for ($start = ShopConfig::OPEN; $start <= ShopConfig::CLOSE; $start += ShopConfig::ONE_FRAME_HOUR) {
            $scheduleBean = new BeanSchedule();
            if ($start == "9") {
                $startDateString = $targetDateString . ' ' . '09' . ':00';
            } else {
                $startDateString = $targetDateString . ' ' . $start . ':00';
            }
            $end = $start + ShopConfig::ONE_FRAME_HOUR;
            $endDateString = $targetDateString . ' ' . $end . ':00';
            $scheduleBean->setStartDate(new \DateTime($startDateString));
            $scheduleBean->setEndDate(new \DateTime($endDateString));
            if (isset($reservationList[$startDateString])) {
                $reservation = $reservationList[$startDateString];
                $scheduleBean->setHasReservation(true);
                $scheduleBean->setNumberOfPeople($reservation->getValue(Reservation::COLUMN_NUMBER_OF_PEOPLE));
            } else {
                $scheduleBean->setHasReservation(false);
            }
            $scheduleBeanList[] = $scheduleBean;
        }
        return $scheduleBeanList;
    }
}
