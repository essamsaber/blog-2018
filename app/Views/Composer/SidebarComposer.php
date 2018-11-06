<?php
/**
 * Created by PhpStorm.
 * User: esam
 * Date: 10/8/2018
 * Time: 1:16 AM
 */

namespace App\Views\Composer;


use App\Category;
use App\Post;
use App\Tag;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $this->composeCategories($view);
        $this->composePopularPosts($view);
        $this->composeTags($view);
        $this->composeArchives($view);
    }

    private function composeCategories($view)
    {
        $categories = Category::with(['posts' => function($query){
            return $query->published();
        }])
            ->orderBy('name', 'ASC')
            ->get();
        $view->with('categories', $categories);
    }

    private function composePopularPosts($view)
    {
        $popular_posts = Post::published()->popular()->take(3)->get();
        $view->with('popular_posts', $popular_posts);
    }

    private function composeTags($view)
    {
        $tags = Tag::has('posts')->get();
        $view->with('tags', $tags);
    }

    private function composeArchives($view)
    {
        $archives = Post::archives();
        $view->with('archives', $archives);
    }
}