<?php

namespace App\Traits;

use App\Models\Image;
use DateTime;
use DateTimeZone;

trait ImageTrait
{
    use ACMU;
    /**
     * @param image (image id)
     * @return string (imagefull path)
     */
    public function getImage($imageId, $type = "original", $mobile = false)
    {

        if (!empty($imageId)) {

           
            $image =  Image::find($imageId) ?? '';
           
        }

        if (empty($image)) {
            // return $mobile ? null : '/assets/cdn/images/placeholder.jpg';
            return '/assets/cdn/images/placeholder.jpg';
        }
        return $this->generateImagePath($image, $type);
    }

    public function generateImagePath(Image $image, $type)
    {

        $DTobj = new DateTime($image->created_at, new DateTimeZone('Asia/Qatar'));
        $time = strtotime($image->created_at);
        $ext = $image->extension;
        $salt = $image->salt;
        $date = date("Ymd", strtotime($image->created_at));

        $path = $this->generate_path($image);

        // dd($path);

        // if(!file_exists($path))    //check the original image
        // {
        //     $path = '/assets/cdn/images/placeholder.jpg';
        //     return $path;
        // }



        if ($type == "original") {
            return '/get/maximage/' . "{$date}_{$time}-{$salt}.{$ext}";
        } else {
            //

            ///
          

            return '/get/image/' . "{$date}_{$time}-{$salt}-{$type}.{$ext}";
        }
    }

    private function computeFilePath($path, $type)
    {
        $ext = @end(explode(".", $path));
        $newPath = str_replace("." . $ext, "", $path);
        return $newPath . "-" . $type . "." . $ext;
    }

   

    

}
