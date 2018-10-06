<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $appends = ['image_url'];
    protected $dates = ['published_at'];
    public function getImageUrlAttribute()
    {
        $image_url = '';
        if($this->image) {
            $image_path = public_path('img').'/'.$this->image;
            if(file_exists($image_path)) $image_url = asset('public/img').'/'.$this->image;
        }
        return $image_url;
    }

    public function getDateAttribute($value)
    {
        return $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}
