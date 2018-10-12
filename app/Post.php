<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
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

    public function getImageThumbAttribute()
    {
        $image_url = '';
        if($this->image) {
            $ext = substr(strrchr($this->image, '.'),1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $image_path = public_path('img').'/'.$thumbnail;
            if(file_exists($image_path)) $image_url = asset('public/img').'/'.$thumbnail;
        }
        return $image_url;
    }

    public function getDateAttribute($value)
    {
        return $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : '';
    }

    public function getExcerptHtmlAttribute($value)
    {
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : '';
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'DESC');
    }

    public function postUrl()
    {
        return route('blog.show', $this->slug);
    }

    public function formattedDate($showTime = false)
    {
        $format = 'd/m/Y';
        if($showTime) $format.= ' H:i:s';
        return $this->created_at->format($format);
    }

    public function publishedLabel()
    {
        if(! $this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        } elseif ($this->published_at->isFuture()) {
            return '<span class="label label-info">Schedule</span>';
        } else {
            return '<span class="label label-success">Published</span>';
        }
    }
}
