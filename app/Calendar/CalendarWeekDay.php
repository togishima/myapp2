<?php

namespace App\Calendar;
use Carbon\Carbon;
use App\Calendar\HolidaySetting;

class CalendarWeekDay {
  protected $carbon;
  protected $isHoliday = false;

  function __construct($date) {
    $this->carbon = new Carbon($date);
  }

  function getClassName() {
    $classNames = ["day-" . strtolower($this->carbon->format("D"))];

    if($this->isHoliday) {
      $classNames[] = "day-holiday";
    }

    return implode(" ", $classNames);
  }

  /**
	 * @return 
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j") . '</p>';
  }
  
  function checkHoliday(HolidaySetting $setting) {
    if($setting->isHoliday($this->carbon)){
			$this->isHoliday = true;
		}
  }
}