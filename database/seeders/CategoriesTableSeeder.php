<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert(
            [
                [
                    'name' => 'Seating',
                    'description' => '',
                ],
                [
                    'name' => 'Lighting',
                    'description' => '',
                ],
                [
                    'name' => 'Tables',
                    'description' => '',
                ],
                [
                    'name' => 'Cabinets & Storage',
                    'description' => '',
                ],
                [
                    'name' => 'Mirrors',
                    'description' => '',
                ],
                [
                    'name' => 'Decorative',
                    'description' => '',
                ],
            ]
        );
    }
}
