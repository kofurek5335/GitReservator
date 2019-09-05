<?php

namespace Reservator;

class Reservation extends CustomModel
{
    //protected $fillable = [
    //    'number_of_people',
    //    'start_at',
    //    'end_at'
    //];
    const TABLE_NAME = 'reservations';

    const COLUMN_ID = 'id';
    const COLUMN_NUMBER_OF_PEOPLE = 'number_of_people';
    const COLUMN_START_AT = 'start_at';
    const COLUMN_END_AT = 'end_at';
    const COLUMN_UPDATED_AT = 'updated_at';
    const COLUMN_CREATED_AT = 'created_at';

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        Reservation::COLUMN_START_AT,
        Reservation::COLUMN_END_AT
    ];
}
