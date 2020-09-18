<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Yasumi\Yasumi;
use Log;

class HolidaySetting extends Model
{
    const DAY_SHIFT = 1;
    const NIGHT_SHIFT = 2;
    const DAY_OFF = 3;
    const UNSET = 0;

    protected $table = "holiday_setting";

    protected $fillable = [
        "date_flag",
        "comment"
    ];

    private $holidays = null;

    function isDayShift() {
        return $this->date_flag == HolidaySetting::DAY_SHIFT;
    }

    function isNightShift() {
        return $this->date_flag == HolidaySetting::NIGHT_SHIFT;
    }

    function isDayOff() {
        return $this->date_flag == HolidaySetting::DAY_OFF;
    }

    function unset() {
        return $this->date_flag == HolidaySetting::UNSET;
    }

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

    /**
     * 指定した月のシフトを取得
     * @return HolidaySetting[]
     */

    public static function getHolidaySettingWithMonth($ym) {
        $holidaySetting = HolidaySetting::Where("user_id", Auth::id())->
        Where("date_key", 'like', $ym . '%')->
        get()->
        keyBy("date_key");
        Log::debug($holidaySetting);
        return $holidaySetting;
    }

    public static function updateHolidaySettingsWithMonth($ym, $input, $user_id) {
        $holidaySettings = Self::getHolidaySettingWithMonth($ym);

        foreach($input as $date_key => $array) {
            //既に作成済みの場合の処理
            if (isset($holidaySettings[$date_key])) {
                 $holidaySetting = $holidaySettings[$date_key];
                 $holidaySetting->fill($array);

                if($holidaySetting->isDayShift() || $holidaySetting->isNightShift() || $holidaySetting->isDayOff()) {
                    $holidaySetting->save();
                } else {
                    $holidaySetting->delete();
                }
                continue;
            }
            //未設定の場合の処理;
            $holidaySetting = new HolidaySetting;
            $holidaySetting->user_id = $user_id;
            $holidaySetting->date_key = $date_key;
            $holidaySetting->fill($array);
            
            if($holidaySetting->isDayShift() || $holidaySetting->isNightShift() || $holidaySetting->isDayOff()) {
                $holidaySetting->save();
            }
        }
    }
}
