<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = ['winner'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'games';
}
