<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Http\Traits\BlogUtilities;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Backend\BaseController as Controller;

class BlogController extends Controller
{
    use BlogUtilities;
    protected $limit = 5;
    protected $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->upload_path = public_path(config('cms.image.dir'));
    }

    public function index(Request $request)
    {
        $allPosts = TRUE;
        if( $request->status && $request->status == 'trashed') {
            $allPosts = false;
            $posts = Post::onlyTrashed()->with('author','category')->latest()->paginate($this->limit);
            $postCount = Post::count();
        } else if($request->status && $request->status == 'scheduled'){
            $posts = Post::scheduled()->with('author','category')->latest()->paginate($this->limit);
            $postCount = Post::scheduled()->count();
        }
        else if($request->status && $request->status == 'published'){
            $posts = Post::published()->with('author','category')->latest()->paginate($this->limit);
            $postCount = Post::published()->count();
        }
        else if($request->status && $request->status == 'draft'){
            $posts = Post::draft()->with('author','category')->latest()->paginate($this->limit);
            $postCount = Post::draft()->count();
        } else {
            $posts = Post::with('author','category')->latest()->paginate($this->limit);
            $postCount = Post::count();
        }
        $filterLists = $this->filtersList();

        return view('backend.blog.index',compact('posts','postCount','allPosts','filterLists'));
    }

    private function filtersList()
    {
        return [
          'all' => Post::withoutTrashed()->count(),
          'published' => Post::published()->count(),
          'scheduled'  => Post::scheduled()->count(),
          'draft' => Post::draft()->count(),
          'trashed' => Post::onlyTrashed()->count()
        ];
    }

    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);
        return redirect()->route('backend.blog.index')->with('success', 'The blog has been added successfully');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time();
            $file_name_with_ext = $file_name.'.'.$extension;
            $destination = $this->upload_path;

            $image_uploaded = $file->move($destination, $file_name_with_ext);
            if($image_uploaded) {
                $thumbnail = $destination.'/'.$file_name.'_thumbnail.'.$extension;
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                Image::make($destination.'/'.$file_name_with_ext)
                    ->resize($width, $height)
                    ->save($thumbnail);
            }
            $data['image'] = $file_name_with_ext;
        }
        return $data;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.blog.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->handleRequest($request);

        $old_image = $post->image;
        $post->update($data);
        if($old_image != $post->image) {
            $this->deleteImage($old_image);
        }
        return redirect()
            ->route('backend.blog.index')
            ->with('success', 'The blog has been updated successfully');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()
            ->route('backend.blog.index')
            ->with('trash-message', ['Your post was deleted successfully!', $id]);
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->deleteImage($post->image);
        $post->forceDelete();
        $redirectToUrl = route('backend.blog.index').'?status=trashed';
        return redirect($redirectToUrl)
            ->with('success', 'Your post was deleted successfully!');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()
            ->back()
            ->with('success', 'The blog has been restored successfully');
    }


}
