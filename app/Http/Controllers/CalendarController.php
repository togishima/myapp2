<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    
    public function show() 
    {
        $calendar = new CalendarView(time());
        return view('calendar', ["calendar" => $calendar]);
    }
    public function specificMonth(Request $request, $year, $month)
    {
        $date = $year. '-' . $month .'-01';
        $calendar = new CalendarView($date);
        return view('calendar', ["calendar" => $calendar]);
    }
}
