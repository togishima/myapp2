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
}
