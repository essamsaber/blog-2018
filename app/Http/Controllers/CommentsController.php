<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function postComment(Request $request, Post $post)
    {
        $this->validateCommentForm($request);
        $comment = $post->storeComment($request->all());
        $url = $this->urlToRedirct($post, $comment);
        return redirect()->to($url)->with('success', 'Your comment has been posted successfully');
    }

    private function validateCommentForm(Request $request): void
    {
        $rules = [
            'author_name' => 'required|max:255',
            'author_email' => 'required|email|max:255',
            'body' => 'required',
        ];
        $this->validate($request, $rules);
    }

    private function urlToRedirct(Post $post, $comment): string
    {
        $url = route('blog.show', $post->slug) . '#comment-' . $comment->id;
        return $url;
    }
}
