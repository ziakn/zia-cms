<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imageFolder')->insert(
            [
                [
                    'user_id' => 1,
                    'parent_id' => 1,
                    'title' => 'name',
                    'status' => 1,
                ]
            ]
        );
    }
}
