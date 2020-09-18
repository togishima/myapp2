<?php
namespace App\Calendar\Form;

use Carbon\Carbon;

use App\Calendar\CalendarWeekDay;
use App\Calendar\HolidaySetting;

class CalendarWeekDayForm extends CalendarWeekDay {
  public $holidaySetting = null;

  /**
   * @return
   */
  function render() {
    //selectの名前
    $select_form_name = "holiday_setting[" . $this->carbon->format("Ymd") . "][date_flag]";
    //コメントのinputの名前
    $comment_form_name = "holiday_setting[" . $this->carbon->format("Ymd") . "][comment]";

    //シフトの初期値
    $defaultValue = '未設定';
    //シフトが選択されているかどうか
    $isSelectedDayShift = ($this->holidaySetting && $this->holidaySetting->isDayShift()) ? 'selected' : '';
    $isSelectedNightShift = ($this->holidaySetting && $this->holidaySetting->isNightShift()) ? 'selected' : '';
    $isSelectedDayOff = ($this->holidaySetting && $this->holidaySetting->isDayOff()) ? 'selected' : '';
    //commentの値
    $comment = ($this->holidaySetting) ? $this->holidaySetting->comment : '';

    //html組み立て用の空配列
    $html = [];

    //日付
    $html[] = '<p class = "day">' . $this->carbon->format("j") . '</p>';
    if($this->holidayName) {
      $div[] = '<span class="holiday-name">' . $this->holidayName .'</span>';
    }
    $html[] = '<select name="' . $select_form_name . '" class="form-control">';
    $html[] = '<option value="0">' . $defaultValue . '</option>';
    $html[] = '<option value="' . HolidaySetting::DAY_OFF . '" '. $isSelectedDayOff . '>休み</option>';
    $html[] = '<option value="' . HolidaySetting::DAY_SHIFT . '" '. $isSelectedDayShift . '>日勤</option>';
    $html[] = '<option value="' . HolidaySetting::NIGHT_SHIFT . '" '. $isSelectedNightShift . '>夜勤</option>';
    $html[] = '</select>';

    //コメント
    if($this->holidaySetting) {
      $html[] = '<input class="form-control" type="text" name="'.$comment_form_name.'" value="'.e($comment).'" placeholder="メモ欄："/>';
    }

    return implode("", $html);
  }
}