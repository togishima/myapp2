<?php

namespace App\Calendar;
use Carbon\Carbon;
use App\Calendar\HolidaySetting;
use App\Task;

class CalendarWeekDay {
  protected $carbon;
  protected $isHoliday_ = false;
  protected $holidayName = null;
  protected $tasks = null;

  function __construct($date) {
    $this->carbon = new Carbon($date);
  }

  function getClassName() {
    $classNames = ["day-" . strtolower($this->carbon->format("D"))];

    if($this->isHoliday_) {
      $classNames[] = "day-holiday";
    }

    return implode(" ", $classNames);
  }

  function getDateKey() {
    return $this->carbon->format("Ymd");
  }

  function setHoliday($flag) {
    $this->date_flag = $flag;
  }

  /**
	 * @return 
	 */
	function render(){
    $div = [];
    $div[] = '<span class="date">'. $this->carbon->format("j") . '</span>';
    if($this->holidayName) {
      $div[] = '<span class="holiday-name">' . $this->holidayName .'</span>';
    }
    if(count($this->tasks) !== 0) {
      $div[] = '<ul class="tasks">';
      foreach($this->tasks as $task) {
        if ($task->completed == null) {
          $div[] = '<li class="task"><a href="/tasks/'. $task->id. '">task#' . $task->id .'</a></li>';
        } else {
          $div[] = '<li class="task text-muted">task#' . $task->id .'(done)</li>';
        }
      }
      $div[] ='</ul>';
    }

		return '<div class="day"> ' . implode("", $div) . '</div>';
  }
  
  function checkHoliday(HolidaySetting $setting) {
    if($setting->isHoliday($this->carbon)){
      $this->isHoliday_ = true;
      $this->holidayName = $setting->getHolidayName($this->carbon->format("Y-m-d"));
    }
  }

  function checkTasks(Task $task) {
    $this->tasks = $task->getTaskByDate($this->carbon->format("Y-m-d"));
  }
}