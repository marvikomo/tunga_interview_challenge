<?php
namespace App\Libraries;

use Carbon\Carbon;

class DateLib{
    public  function covertToTime($date){
        $a = str_replace("/", "-", $date);;
        return strtotime($a);
    }
    public function getAge($date){
        return Carbon::parse($date)->diff(Carbon::now())->y;
    }
}
