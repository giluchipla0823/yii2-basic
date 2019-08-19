<?php

namespace app\components\helpers;

class DateHelper
{
    public static function getDateFromUserToSql($date){
        $date = str_replace('/', '-', $date );

        return date("Y-m-d", strtotime($date));
    }

    public static function getDateFromSqlToUser($date){
        $date = str_replace('-', '/', $date );

        return date("d/m/Y", strtotime($date));
    }
}