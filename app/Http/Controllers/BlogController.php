<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 5;
    public function index()
    {
        $posts = Post::with('author')
            ->with('category')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index', compact('posts','categories'));
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);
        return view('blog.index', compact('categories','posts'));
    }

}
