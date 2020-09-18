<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\Output\CalendarOutputView;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    
    public function show() 
    {
        $calendar = new CalendarOutputView(time());
        return view('calendar.calendar', ["calendar" => $calendar]);
    }
    public function specificMonth(Request $request, $year, $month)
    {
        $date = $year. '-' . $month .'-01';
        $calendar = new CalendarOutputView($date);
        return view('calendar.calendar', ["calendar" => $calendar]);
    }
}
