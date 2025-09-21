<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateTimeHelper
{
    public static function dateTimeToMinus3Format($dateTime)
    {
        return Carbon::parse($dateTime, 'UTC')
            ->setTimezone('America/Sao_Paulo')
            ->format('d/m/Y H:i:s');
    }

    public static function dateFormat($date)
    {
        return Carbon::parse($date, 'UTC')
            ->format('d/m/Y');
    }

    public static function timeFormat($date)
    {
        return Carbon::parse($date, 'UTC')
            ->setTimezone('America/Sao_Paulo')
            ->format('H:i:s');
    }
}
