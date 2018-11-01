<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $appends = ['image_url'];
    protected $dates = ['published_at','deleted_at'];
    protected $fillable = ['title','slug','excerpt','body','category_id', 'published_at','image','author_id'];

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
            $thumbnail = str_replace(".{$ext}", "_thumbnail.{$ext}", $this->image);
            $image_path = public_path(config('cms.image.dir')).'/'.$thumbnail;
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


    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: NULL;
    }


    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'DESC');
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }


    public function scopeScheduled($query)
    {
        return $query->where('published_at', '>', Carbon::now());
    }
}
