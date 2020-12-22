<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'category_id',
       'title',
       'body',
   ];

   public function category(){
      return $this->belongsTo('App\Models\Category');
    }

    public function user(){
     return $this->belongsTo('App\Models\User');
   }

   public function comments()
   {
    return $this->hasMany('App\Models\Comment');
   }

   public function upload_image(){
    return $this->hasOne('App\Models\UploadImage');
  }

  public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

}
