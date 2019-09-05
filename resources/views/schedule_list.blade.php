@extends('common.layout')

@section('body')

@inject('AppConfig', 'Reservator\Config\AppConfig')

<div class="d-flex justify-content-center align-items-center">
<div class="container">


<form action="/schedule" method="post">
@csrf
<input type="date" name="searchdate">
<input type="submit" value="日付を指定して検索" class="btn btn-primary btn-sm m-4 p-2">
</form>

<a href="/schedule" class="btn btn-info btn-sm m-2">更新</a>

<h3>
@if (isset ($targetDateString))
   {{$targetDateString}}の予約一覧
@else
    @php
    echo date('Y-m-d') . "の予約一覧";
    @endphp
@endif
</h3>


<table class="table table-bordered">
<thead class="thead-light">
    <tr>
        <th>予約時間</th>
        <th>予約状況</th>
    </tr>

@foreach($scheduleBeanList as $scheduleBean)

    <tr>

	    <td>{{$scheduleBean->getStartDate()->format($AppConfig::FORMAT_TIME)}}</td>

	@if($scheduleBean->getHasReservation() == true)
		<td>予約  {{$scheduleBean->getNumberOfPeople()}}名様</td>
	@else
		<td></td>
	@endif

	</tr>

@endforeach
</table>
</div>
</div>


@endsection