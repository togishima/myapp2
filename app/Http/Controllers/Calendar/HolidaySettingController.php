<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\HolidaySetting;

class HolidaySettingController extends Controller
{
    function form() {
        $setting = HolidaySetting::firstOrNew();
        return view("calendar/holiday_setting_form", [
            "setting" => $setting,
            "FLAG_DAYSHIFT" => HolidaySetting::DAY_SHIFT,
            "FLAG_NIGHTSHIFT" => HolidaySetting::NIGHT_SHIFT,
            "FLAG_HOLIDAY" => HolidaySetting::HOLIDAY,
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
