<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $gureded=[];
    public function posts(){
        return $this->hasMany('App\Models\Post','user_id','id');
    }

    public function comments(){
        return $this->belongsTo('App\Models\Comment','post_id','id');
    }

}
