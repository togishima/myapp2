<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;
use Yasumi\Yasumi;
use Log;

class HolidaySetting extends Model
{
    const DAY_SHIFT = 1;
    const NIGHT_SHIFT = 2;
    const HOLIDAY = 3;

    protected $table = "holiday_setting";

    protected $fillable = [
        "flag_mon",
        "flag_tue",
        "flag_wed",
        "flag_thu",
        "flag_fri",
        "flag_sat",
        "flag_sun",
        "flag_holiday",
    ];

    private $holidays = null;

    function loadHoliday($year) {
        $this->holidays = Yasumi::create("Japan", $year, "ja_JP");
    }

    function isHoliday($date) {
        if($this->holidays) {
            return $this->holidays->isHoliday($date);
        }
        return false;
    }

    function getHolidayName($date) {
        foreach($this->holidays as $holiday) {
            if($holiday == $date) {
                return $holiday->getName();
            }
        }
    }
}
