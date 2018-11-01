<?php
/**
 * Created by PhpStorm.
 * User: esam
 * Date: 11/2/2018
 * Time: 1:42 AM
 */

namespace App\Http\Traits;


trait BlogUtilities
{
    private function deleteImage($image)
    {
        if($image) {
            $image_path = $this->upload_path.'/'.$image;
            $ext = substr(strrchr($image, '.'),1);
            $thumbnail = str_replace(".{$ext}", "_thumbnail.{$ext}", $image);
            $thumbnail_path = $this->upload_path.'/'.$thumbnail;
            if(file_exists($image_path))    unlink($image_path);
            if(file_exists($thumbnail_path))    unlink($thumbnail_path);
        }
    }
}