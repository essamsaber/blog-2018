<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        $image_url = '';
        if($this->image) {
            $image_path = public_path('img').'/'.$this->image;
            if(file_exists($image_path)) $image_url = asset('public/img').'/'.$this->image;
        }
        return $image_url;
    }
}
