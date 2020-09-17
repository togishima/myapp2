<?php

namespace App\Kanban;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = ['title', 'memo'];
    protected $dates = ['deleted_at'];
}
