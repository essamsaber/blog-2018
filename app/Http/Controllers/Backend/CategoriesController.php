<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\DestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    protected $limit = 5;

    public function index()
    {
        $categories = Category::with('posts')->orderBy('name')->paginate($this->limit);
        $categoriesCount = Category::count();
        return view('backend.categories.index', compact('categories', 'categoriesCount'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    public function create()
    {
        $category = new Category();
        return view('backend.categories.create', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Your category has been updated successfully!');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'New category has been added successfully!');
    }

    public function destroy(DestroyCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->posts()->withTrashed()->each(function($post){
            return $post->update(['category_id' => config('cms.default_category_id')]);
        });
        $category->delete();
        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Your category has been deleted successfully!');
    }
}
