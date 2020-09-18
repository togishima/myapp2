<?php

namespace App\Calendar;

use Carbon\Carbon;
use App\Calendar\HolidaySetting;
use App\Task;
use Log;

class CalendarView {
  protected $carbon;
  protected $holidaySettings = [];

  function __construct($date) {
    $this->carbon = new Carbon($date);
  }

  public function getTitle() {
    $title = $this->carbon->format('Y年n月');
    return $title;
  }

  public function getPrevMonth() {
    $prev = $this->carbon->copy()->subMonthsNoOverflow()->format('Y/m');
    return $prev;
  }

  public function getNextMonth(){
    $next = $this->carbon->copy()->addMonthsNoOverflow()->format('Y/m');
    return $next;
  }

  protected function getWeeks() {
    $weeks = [];

    //初日
    $firstDay = $this->carbon->copy()->firstOfMonth();
    //末日
    $lastDay = $this->carbon->copy()->lastOfMonth();

    //１週目
    $weeks[] = $this->getWeek($firstDay->copy());

    //作業用の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

    //
    while($tmpDay->lte($lastDay)) {
      //週カレンダーViewを作成
      $weeks[] = $this->getWeek($tmpDay->copy(), count($weeks));

      //次の週+=7日
      $tmpDay->addDay(7);
    }
    return $weeks;
  }

  /**
	 * @return CalendarWeek
	 */
	protected function getWeek(Carbon $date, $index = 0){
		return new CalendarWeek($date, $index);
	}

  function render() {
    //Holiday Setting
    $setting = HolidaySetting::firstOrNew();
    $setting ->loadHoliday($this->carbon->format("Y"));

    //LoadTask
    $task = Task::firstOrNew();
    $this->holidaySettings = HolidaySetting::getHolidaySettingWithMonth($this->carbon->format("Ym"));

    //table html
    $html = [];
    $html[] = '<div class="calendar">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';

    $html[] = '<tbody>';

    $weeks = $this->getWeeks();
    foreach($weeks as $week) {
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays($setting, $task);
      foreach($days as $day) {
        $html[] = $this->renderDay($day);
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';

    $html[] = '</table>';
    $html[] = '</div>';
    return implode("", $html);
  }
  protected function renderDay(CalendarWeekDay $day)
  {
    $html = [];
    $html[] = '<td class="'.$day->getClassName().'">';
    $html[] = $day->render();
    $html[] = '</td>';
    return implode("", $html);
  }
}