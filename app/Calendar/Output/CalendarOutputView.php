<?php
namespace App\Calendar\Output;
use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;
use App\Calendar\HolidaySetting;
use App\Task;
use Log;

/**
 * 表示用クラス
 */
class CalendarOutputView extends CalendarView {
  protected $carbon;
  protected $holidaySettings = [];
  /**
   * 日を描画する
   */
  protected function renderDay(CalendarWeekDay $day) {
    $html = [];
    $html[] = '<td class="'.$day->getClassName().'">';
    $html[] = $day->render();
    $html[] = self::getWorkShift($day);
    $html[] = self::checkTasks($day);
    $html[] = '</td>';

    return implode("", $html);
  }

  protected function getWorkShift($day) {
    $this->holidaySettings = HolidaySetting::getHolidaySettingWithMonth($this->carbon->format("Ym"));
    //シフトの表示
    if(isset($this->holidaySettings[$day->getDateKey()])) {
      $workShift = $this->holidaySettings[$day->getDateKey()];
      $ws = [];
      $ws[] = '<span class="badge work-shift';
      //date_flagによって配列に追加する文字列を変更
      switch ($workShift->date_flag) {
        case 1: 
          $ws[] = ' shift-day badge-success">日勤';
        break;
        case 2: 
          $ws[] = ' shift-night badge-primary">夜勤';
        break;
        case 3: 
          $ws[] = ' shift-day-off badge-secondary">休み';
      }
      $ws[] = '</span>';
      $ws[] = '<span class="comment">' . $workShift->comment . '</span>';
      return implode("", $ws);
    }
  }

  protected function checkTasks($day) {
    $this->tasks = Task::getTaskByDate($day->getFormattedDate());
    if($this->tasks) {
      $ul[] = '<ul class="tasks">';
      foreach($this->tasks as $task) {
        if ($task->completed == null) {
          $ul[] = '<li class="task"><a href="/tasks/'. $task->id. '">task#' . $task->id .'</a></li>';
        } else {
          $ul[] = '<li class="task text-muted">task#' . $task->id .'(done)</li>';
        }
      }
      $ul[] ='</ul>';
      return implode("", $ul);
    }
  }
}