<?php

namespace App\Kanban;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listings';
    protected $fillable = ['title', 'description', 'board_id'];
    protected $dates = ['deleted_at'];

    public function card()
    {
        return $this->hasMany('App\Kanban\Card');
    }
}
