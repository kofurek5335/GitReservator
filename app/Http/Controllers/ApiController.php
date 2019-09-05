<?php
namespace Reservator\Http\Controllers;

use Illuminate\Http\JsonResponse;
use function Illuminate\Foundation\Testing\Concerns\shouldReport;
use Reservator\Config\AppConfig;
use Reservator\Reservation;

class ApiController extends Controller
{
    public function getScheculeList(string $date): JsonResponse
    {
        if (isset($date)) {
            $dateString = $date;
            $targetDate = new \DateTime($dateString);
        } else {
            $targetDate = new \DateTime();
        }

        $targetDateString = $targetDate->format(AppConfig::FORMAT_DATE);
        //try catchで、DB接続に失敗した場合の処理を準備する。
        try {
            $dataList = Controller::getDataList($targetDateString);
        } catch (\Exception $e) {
            return response()->json([
                [ 'result' => 'NG' ]
            ]);

        }

        $scheduleBeanList = Controller::getScheduleBeanList($dataList, $targetDateString);

        $scheduleList = array();
        foreach ($scheduleBeanList as $schedule) {

            $startTime = $schedule->getStartDate();
            $formatStartTime = $startTime->format(AppConfig::FORMAT_TIME);
            $endTime = $schedule->getEndDate();
            $formatEndTime = $endTime->format(AppConfig::FORMAT_TIME);
            $hasReservation = $schedule->getHasReservation();

            $ary = array (
                "start" => $formatStartTime,
                "end" => $formatEndTime,
                "hasReservation" => $hasReservation
            );
            $scheduleList[] = $ary;
        }

        $json = array (
            "result" => "OK",
            "date" => $date,
            "open" => "09:00",
            "close" => "21:00",
            "interval" => 1,
            "scheduleList" => $scheduleList
        );
        return response()->json($json);
    }

    public function reservationRequest(string $datetime, string $count): JsonResponse
    {
        //ユーザーからの予約希望日時インスタンス化してフォーマットする。
        $dateTimeObject = new \DateTime($datetime);
        $reserveDateTime = $dateTimeObject->format(AppConfig::FORMAT_DATE_TIME);
        //DBアクセスの準備
        $query = Reservation::query();
        //ユーザーの希望した日時でDBを検索。
        $query->where(Reservation::COLUMN_START_AT, $reserveDateTime);
        $result = $query->get();
        //検索した日時に予約データが存在しなければ、新しい予約をインサートする。
        if ($result != null && $result -> isEmpty()) {

            $reserveData = new Reservation();
            //引数の$countをstringからintに変換。DBへインサートする準備。
            $intCount = (int)$count;
            //準備したReservationインスタンスにデータをセットしていく。
            $reserveData->setValue(Reservation::COLUMN_NUMBER_OF_PEOPLE, $intCount);
            $reserveData->start_at = $dateTimeObject;
            //インサート実行
            $reserveData->save();
            //データがインサートできたらJSON形式で「OK」を返す。
            return response()->json([
                [ 'result' => 'OK' ]
            ]);
            //$resultがnullではない = すでに予約データが存在している → JSON形式で「NG」を返す。
        } else {
            return response()->json([
                [ 'result' => 'NG' ]
            ]);
        }
    }
}
