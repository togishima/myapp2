<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\Form\CalendarFormView;
use App\Calendar\HolidaySetting;
use Log;

class HolidaySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    function form() 
    {
        $calendar = new CalendarFormView(time());
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
        $input = $request->get("holiday_setting");
        $ym = $request->input("ym");
        $user_id = $request->get("user_id");

        HolidaySetting::updateHolidaySettingsWithMonth($ym, $input, $user_id);
        return redirect()
            ->action("Calendar\HolidaySettingController@form")
            ->withStatus("保存しました");
    }
}
