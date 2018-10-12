<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 5;
    public function index()
    {
        $posts = Post::with('author','category')->latest()->paginate($this->limit);
        $postCount = Post::count();
        return view('backend.blog.index',compact('posts','postCount'));
    }
}
