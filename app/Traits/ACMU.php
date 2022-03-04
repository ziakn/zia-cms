<?php

namespace App\Traits;

/**
 * BE CAUTIOUS BEFORE EDITING THIS FILE
 * THIS FILE CONTAINS COMMON MODEL CORE FUNCTIONALITIES
 * 2021-06-13 BY MM
 */

use App\Models\Image;
use App\SPC\MenuCategoryClass;

trait ACMU
{
    // use CategoryTrait;

    public function generate_path(Image $img)
    {

        if (!empty($img)) {

            $data = $img;
            $date = $data->created_at;
            $split = explode(" ", $date);
            $separate = explode("-", $split[0]);
            $year = $separate[0];
            $month = $separate[1];
            $day = $separate[2];
            $totime = strtotime($data->created_at);
            $salt = $data->salt;
            $file_name = "{$year}{$month}{$day}_{$totime}-{$salt}.{$data->extension}";
// dd($file_name);
            $sub_folder = $totime . "-" . $salt;
            $path_of_folder = "/files/images/{$year}/{$month}/{$day}/{$sub_folder}/";
            $path_of_folder_file = "/storage/files/images/{$year}/{$month}/{$day}/{$sub_folder}/{$file_name}";
            return $path_of_folder_file;
        } else {
            // return 'no-image'; // commented because of API
            return '';
        }
    }
}
