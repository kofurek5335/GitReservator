<?php
namespace Reservator\Http\Controllers;

use Illuminate\Support\Facades\View;
use Reservator\Config\HttpKeyConfig;
use function Illuminate\Foundation\Testing\Concerns\shouldReport;
use Illuminate\Http\Request;
use Reservator\Config\AppConfig;

class ViewController extends Controller
{
    public function scheculeList(Request $request): \Illuminate\Contracts\View\View
    {
        if ($request->has('searchdate')) {
            $dateString = $request->input('searchdate');
            $targetDate = new \DateTime($dateString);
        } else {
            $targetDate = new \DateTime();
        }

        $targetDateString = $targetDate->format(AppConfig::FORMAT_DATE);
        $dataList = Controller::getDataList($targetDateString);
        $scheduleBeanList = Controller::getScheduleBeanList($dataList, $targetDateString);

        //Viewを作り、値を渡す
        $view = View::make('schedule_list');
        $view->with(HttpKeyConfig::TITLE, '予約一覧');
        $view->with('scheduleBeanList', $scheduleBeanList);
        $view->with('targetDateString', $targetDateString);
        return $view;
    }
}
