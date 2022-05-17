<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert(
            [
                [
                    'name' => 'Bamboo Mirror',
                    'description' => 'Bamboo Mirror',
                    'price' => 20,
                    'category_id' => 5,
                    'photo' => 'bamboo_mirror_shelf3.JPG',
                ],
                [
                    'name' => 'Green Joiners Drawers',
                    'description' => 'Green Joiners Drawers',
                    'price' => 20,
                    'category_id' => 4,
                    'photo' => 'green_joiners_drawers5.JPG',
                ],
                [
                    'name' => 'Gypsy Table',
                    'description' => 'Gypsy Table',
                    'price' => 20,
                    'category_id' => 3,
                    'photo' => 'gypsy_table1.JPG',
                ],
                [
                    'name' => 'Park Signs',
                    'description' => 'Park Signs',
                    'price' => 20,
                    'category_id' => 6,
                    'photo' => 'Park_signs2.JPG',
                ],
                [
                    'name' => 'Wood & Rattan Fender',
                    'description' => 'Wood & Rattan Fender',
                    'price' => 20,
                    'category_id' => 3,
                    'photo' => 'fender4.JPG',
                ],
                [
                    'name' => 'Grey Plan Chest',
                    'description' => 'Grey Plan Chest',
                    'price' => 20,
                    'category_id' => 4,
                    'photo' => 'Grey_plan_chest1.JPG',
                ],
                [
                    'name' => 'Watchmakers Drawers',
                    'description' => 'Watchmakers Drawers',
                    'price' => 20,
                    'category_id' => 4,
                    'photo' => 'watchmakes_drawers3.JPG',
                ],
                [
                    'name' => 'Painted Drawers',
                    'description' => 'Painted Drawers',
                    'price' => 20,
                    'category_id' => 4,
                    'photo' => 'Painted_drawers5.JPG',
                ],
                [
                    'name' => 'Treacle Glazed COD',
                    'description' => 'Treacle Glazed COD',
                    'price' => 20,
                    'category_id' => 4,
                    'photo' => 'treacle_glazed_drawers1.JPG',
                ],
                [
                    'name' => 'Vicar Painting',
                    'description' => 'Vicar Painting',
                    'price' => 20,
                    'category_id' => 6,
                    'photo' => 'young_vicar_painting2.JPG',
                ],
            ]
        );
    }
}
