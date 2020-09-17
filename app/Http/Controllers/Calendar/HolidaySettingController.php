<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\HolidaySetting;

class HolidaySettingController extends Controller
{
    function form() 
    {
        $calendar = new CalendarView(time());
        $setting = HolidaySetting::firstOrNew();

        return view("calendar.holiday_setting_form", [
            "calendar" => $calendar,
            "setting" => $setting,
            "FLAG_DAYSHIFT" => HolidaySetting::DAY_SHIFT,
            "FLAG_NIGHTSHIFT" => HolidaySetting::NIGHT_SHIFT,
            "FLAG_DAYOFF" => HolidaySetting::DAY_OFF,
        ]);
    }

    function update(Request $request) {
        $setting = HolidaySetting::firstOrNew();

        $setting->update($request->all());
        return redirect()
        ->action("Calendar\HolidaySettingController@form")
        ->withStatus("保存しました");
    }
}
