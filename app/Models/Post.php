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
      return $this->belongsTo('App\models\Category');
    }

    public function user(){
     return $this->belongsTo('App\models\User');
   }

   public function comments()
   {
    return $this->hasMany('App\models\Comment');
   }

   public function upload_image(){
    return $this->hasOne('App\models\UploadImage');
  }

  public function users()
    {
        return $this->belongsToMany('App\models\User')->withTimestamps();
    }

}
