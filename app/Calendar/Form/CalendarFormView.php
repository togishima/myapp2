<?php
namespace App\Calendar\Form;
use Carbon\Carbon;
use App\Calendar\CalendarView;
/**
* 表示用
*/
class CalendarFormView extends CalendarView {
  /**
   * @return CalendarWeekForm
   */ 
  protected function getWeek(Carbon $date, $index = 0) {
    $week = new CalendarWeekForm($date, $index);

    //シフトの表示用
    $start = $date->copy()->startOfWeek()->format("Ymd");
    $end = $date->copy()->endOfWeek()->format("Ymd");

    $week->holidaySettings = $this->holidaySettings->filter(function($value, $key) use($start, $end) {
      return $key >= $start && $key <= $end;;
    })->keyBy("date_key");

    return $week;
  }
}