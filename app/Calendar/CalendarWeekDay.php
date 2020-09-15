<?php

namespace App\Calendar;
use Carbon\Carbon;
use App\Calendar\HolidaySetting;
use Log;

class CalendarWeekDay {
  protected $carbon;
  protected $isHoliday_ = false;
  protected $holidayName = null;

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

  /**
	 * @return 
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j") . '</p>';
  }
  
  function checkHoliday(HolidaySetting $setting) {
    if($setting->isHoliday($this->carbon)){
      $this->isHoliday_ = true;
      $this->holidayName = $setting->getHolidayName($this->carbon->format("Y-m-d"));
    }
  }
}