<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
        [
          'user_id' => 1,
          'post_id' => 1,
          'body' => 'test',
          'created_at' => '2020-12-01 00:00:00'
        ],
        [
          'user_id' => 1,
          'post_id' => 2,
          'body' => 'test',
          'created_at' => '2020-12-01 00:00:00'
        ],
        [
          'user_id' => 1,
          'post_id' => 3,
          'body' => 'test',
          'created_at' => '2020-12-01 00:00:00'
        ]
      ]);
    }
}
