<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'body',
      // 'created_at'
  ];

  public function post()
  {
      return $this->belongsTo('App\Models\Post');
  }

  public function user(){
      return $this->belongsTo('App\Models\User');
  }

  public function upload_image(){
   return $this->hasOne('App\Models\UploadImage');
 }

}
