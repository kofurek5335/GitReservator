<?php

use Illuminate\Support\Facades\Route;
use Reservator\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/schedule/{date}', ApiController::class . '@getScheculeList');
Route::get('/reserve/{datetime}/people/{count}', ApiController::class . '@reservationRequest');
