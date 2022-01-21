<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(
            [
                [
                    'title' => 'Default Parent',
                    'description' => 'Default Parent',
                    'parent_id' => '0',
                    'sort' => '1',
                    'link' => '#',
                    'status' => 1,
                    'slug' => 'menu',
                ],
            ]
        );
    }
}
