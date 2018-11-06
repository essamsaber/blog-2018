<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 5;
    public function index()
    {
        $posts = Post::with('author','category','tags')
            ->latestFirst()
            ->published()
            ->filter(request()->only(["term","month","year"]))
            ->simplePaginate($this->limit);
        return view('blog.index', compact('posts','categories'));
    }



    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }

    public function category(Category $category)
    {
        $category_name = $category->name;
        $posts = $category->posts()
                        ->with('author','category','tags')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);
        return view('blog.index', compact('category_name','posts'));
    }

    public function author(User $author)
    {
        $author_name = $author->name;
        $posts = $author->posts()->with('author','category','tags')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index', compact('posts', 'author_name'));
    }

    public function tag(Tag $tag)
    {
        $tag_name = $tag->name;
        $posts = $tag->posts()
            ->with('author','tags','category')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index', compact('tag_name','posts'));
    }

}
