<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","post_id","comment_id","file_name","file_path"];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comment(){
        return $this->belongsTo('App\Models\Comment');
    }
}
