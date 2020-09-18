<?php
namespace App\Calendar\Form;

use Carbon\Carbon;
use App\Calendar\CalendarWeek;
use App\Calendar\HolidaySetting;
use App\Task;

class CalendarWeekForm extends CalendarWeek {

  /**
   * HolidaySetting[]
   */
  public $workShifts = [];


  /**
   * @return CalendarWeekDayForm
   */
  function getDay(Carbon $date, HolidaySetting $setting, Task $task){
		$day = new CalendarWeekDayForm($date);
    $day->checkHoliday($setting);
    $day->checkTasks($task);

    if(isset($this->holidaySettings[$day->getDateKey()])) {
      $day->holidaySetting = $this->holidaySettings[$day->getDateKey()];
    }
		return $day;
	}
}