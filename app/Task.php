<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        $task = self::where('user_id', $user_id)->sortable()->paginate(10);

        return $task;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
