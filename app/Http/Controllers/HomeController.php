<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Calendar\CalendarView;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calendar = new CalendarView(time());
        return view('welcome', ["calendar" => $calendar]);
    }

    public function getLogout() {
        Auth::logout();
        return redirect('/')->with('message', 'ログアウトしました');
    }
}
