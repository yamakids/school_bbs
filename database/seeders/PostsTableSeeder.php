<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use App\models\Post;
// use App\models\Comment;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post::factory(50)
        //  ->create()
        //  ->each(function ($post) {
        //      $comments =  Comment::factory(2)->make();
        //      $post->comments()->saveMany($comments);
        //  });

        DB::table('posts')->insert([
          [
            'user_id' => 1,
            'category_id' => 1,
            'title' => '○○小学校',
            'body' => 'test',
            'created_at' => '2020-12-01 00:00:00'
          ],
          [
            'user_id' => 1,
            'category_id' => 2,
            'title' => '○○中学校',
            'body' => 'test',
            'created_at' => '2020-12-01 00:00:00'
          ],
          [
            'user_id' => 1,
            'category_id' => 3,
            'title' => '高校',
            'body' => 'test',
            'created_at' => '2020-12-01 00:00:00'
          ]
      ]);
    }
}
