<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;

class Task extends Model
{
    use Sortable;
    use SoftDeletes;
    
    protected $table = 'tasks';
    protected $fillable = ['subject', 'due_date', 'completed', 'description', 'user_id', 'priority'];
    protected $dates = ['deleted_at'];
    protected $sortable = ['id', 'due_date', 'completed'];

    public static function getSortableLinkWithPagination() {
        $user_id = Auth::id();
        $tasks = self::where('user_id', $user_id)->orderBy('due_date')->sortable()->paginate(5);

        return $tasks;
    }

    public static function getTaskByDate($date) {
        $user_id = Auth::id();
        $tasks = self::where('user_id', $user_id)
        ->where('due_date', $date)
        ->get();

        return $tasks;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
