<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
           'name' => 'school',
           'email' => 'school@ddd',
           'password' => bcrypt('school'),
           'email_verified_at' => '2020-12-01 00:00:00',
           'created_at' => '2020-12-01 00:00:00'
       ]);
    }
}
