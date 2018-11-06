<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getDateAttribute($value)
    {
        return $this->created_at->diffForHumans();
    }

    public function getHtmlBodyAttribute($value)
    {
        return Markdown::convertToHtml(e($this->body));
    }
}
