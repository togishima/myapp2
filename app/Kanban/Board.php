<?php

namespace App\Kanban;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';
    protected $fillable = ['title', 'description'];
    protected $dates = ['deleted_at'];
    //
    public function list()
    {
        return $this->hasMany('App\Kanban\Listing');
    }

}
