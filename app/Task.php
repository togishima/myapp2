<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use Sortable;
    
    protected $table = 'tasks';
    protected $fillable = ['subject', 'due_date', 'completed', 'description'];
    public $sortable = ['id', 'due_date', 'completed'];
}
