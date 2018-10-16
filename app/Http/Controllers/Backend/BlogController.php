<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    protected $limit = 5;
    protected $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->upload_path = public_path(config('cms.image.dir'));
    }

    public function index()
    {
        $posts = Post::with('author','category')->latest()->paginate($this->limit);
        $postCount = Post::count();
        return view('backend.blog.index',compact('posts','postCount'));
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
            $file_name = time().'.'.$extension;
            $destination = $this->upload_path;

            $image_uploaded = $file->move($destination, $file_name);
            if($image_uploaded) {
                $thumbnail = $destination.'/'.'thumbnail_'.$file_name;
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                Image::make($destination.'/'.$file_name)
                    ->resize($width, $height)
                    ->save($thumbnail);
            }
            $data['image'] = $file_name;
        }
        return $data;
    }
}
