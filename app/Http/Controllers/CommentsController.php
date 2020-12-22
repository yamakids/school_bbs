<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Post;
use App\models\Comment;
use App\Models\UploadImage;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
  public function index(){
    $id = Auth::id();
  }

  // コメントを投稿する
  public function store(CommentRequest $request)
 {
     $id = Auth::id();
     $params = [
         'post_id' => $request->post_id,
         'user_id' => $request->user_id,
         'body' => $request->body,
     ];

     $post = Post::findOrFail($params['post_id']);
     $post->comments()->create($params);

      if($request->image == null){
         return redirect()->route('posts.show', ['id' => $id,'post' => $post]);
      }
         $comment_id = Comment::max('id');

        if($request->file('image')){
          $upload_image = $request->file('image');
          if($upload_image) {
            //アップロードされた画像を保存する
            $path = $upload_image->store('uploads',"public");
            //画像の保存に成功したらDBに記録する
            if($path){
              UploadImage::create([
                 'user_id' => $request->user_id,
                 'comment_id' => $comment_id,
                "file_name" => $upload_image->getClientOriginalName(),
                "file_path" => $path
              ]);
            }
        }
     return redirect()->route('posts.show', ['id' => $id,'post' => $post]);
  }
 }
}
