<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        ['category_name' => '小学校'],
        ['category_name' => '中学校'],
        ['category_name' => '高校'],
        ['category_name' => '専門学校・大学'],
        ['category_name' => 'その他'],
    ]);
    }
}
