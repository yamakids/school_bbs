<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;

class ShowController extends Controller
{
// 投稿の詳細、コメントを表示
  public function show($post_id)
  {
      $post = Post::findOrFail($post_id);

      return view('shows.show', [
          'post' => $post,
      ]);
  }
}
