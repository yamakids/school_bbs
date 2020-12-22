<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Post;
use App\Models\UploadImage;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
  // 投稿の一覧表示
  public function index()
   {
       return view('posts.index');
   }

// 投稿を行うページを表示
  public function create()
  {
      $id = Auth::id();
      return view('posts.create', ['id' => $id]);
  }

// 新規投稿する
  public function store(PostRequest $request)
  {
      $params = [
          'title' =>  $request->title,
          'body' =>  $request->body,
          'user_id'  =>  $request->user_id,
          'category_id'  =>  $request->category_id,
      ];

       Post::create($params);

      $post_id = Post::max('id');

      $upload_image = $request->file('image');

		if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			//画像の保存に成功したらDBに記録する
			if($path){
				UploadImage::create([
          'user_id' => $request->user_id,
          'post_id' => $post_id,
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
			}
		}

      return redirect()->route('dashboard');
  }

// 投稿の詳細、コメントを表示
  public function show($post_id)
  {
      $id = Auth::id();
      $post = Post::findOrFail($post_id);

      return view('posts.show', [
          'id' => $id,
          'post' => $post,
      ]);
  }

// 投稿内容を編集するページを表示
  public function edit($post_id)
  {
      $post = Post::findOrFail($post_id);
      $post->with(['user','category','upload_image']);

      return view('posts.edit', [
          'post' => $post,
      ]);
  }

// 投稿内容を更新する
  public function update($post_id, PostRequest $request)
  {
      $params = [
          'title' => $request->title,
          'body' => $request->body,
          'user_id' => $request->user_id,
          'category_id' => $request->category_id,
      ];

      $post = Post::findOrFail($post_id);
      $post->fill($params)->save();

      $upload_image = $request->file('image');

    if($upload_image) {
      //アップロードされた画像を保存する
      $path = $upload_image->store('uploads',"public");
      //画像の保存に成功したらDBに記録する
      if($path){
        $param = [
          'user_id' => $request->user_id,
          'post_id' => $post_id,
          "file_name" => $upload_image->getClientOriginalName(),
          "file_path" => $path
        ];
        $UploadImage = UploadImage::where('post_id', $post_id)->first();
        if($UploadImage){
          $UploadImage->fill($param)->save();
        }else{
          UploadImage::create($param);
        }
       }
      }

      $id = Auth::id();

      return redirect()->route('posts.show', [
        'post' => $post,
        'id' => $id
      ]);
  }

// 投稿を削除する
  public function destroy($post_id)
  {
      $post = Post::findOrFail($post_id);

      $post->delete();

      return redirect()->route('dashboard');
  }


}
