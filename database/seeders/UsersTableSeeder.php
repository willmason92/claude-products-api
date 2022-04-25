<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@gmail.com')->delete();

        DB::table('users')->insert([
            'name' => 'Will Mason',
            'email' => 'willmason@live.com',
            'password' => bcrypt('password'),
            'type' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Cary Davies',
            'email' => 'cary@claudeandthepigeon.co.uk',
            'password' => bcrypt('password'),
            'type' => '',
        ]);
    }
}
