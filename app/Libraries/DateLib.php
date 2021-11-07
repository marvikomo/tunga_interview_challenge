<?php
namespace App\Libraries;

use Carbon\Carbon;

class DateLib{
    public static function covertToTime($date){
        $a = str_replace("/", "-", $date);;
        return strtotime($a);
    }
    public static function getAge($date){
        return Carbon::parse($date)->diff(Carbon::now())->y;
    }
    public static function ageFilter($age){
        if(($age >= 18 and $age <= 65) || !$age ){
            return true;
        }
        return false;
    }
}
