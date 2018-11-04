<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Traits\BlogUtilities;
use App\User;
class UsersController extends Controller
{
    use BlogUtilities;

    protected $limit = 5;

    public function index()
    {
        $users = User::with('posts')->orderBy('name')->paginate($this->limit);
        $usersCount = User::count();
        return view('backend.users.index', compact('users', 'usersCount'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    public function create()
    {
        $user = new User();
        return view('backend.users.create', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->detachRoles();
        $user->attachRole($request->role);
        return redirect()
            ->route('backend.users.index')
            ->with('success', 'Your User has been updated successfully!');
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($request->name);
        $user = User::create($data);
        $user->attachRole($request->role);
        return redirect()
            ->route('backend.users.index')
            ->with('success', 'New User has been added successfully!');
    }

    public function destroy(DestroyUserRequest $request, $id)
    {
        $delete_option = $request->delete_option;
        $selected_user = $request->selected_user;
        $user = User::findOrFail($id);

        if($delete_option == 'delete') {
            $user->posts()->withTrashed()->each(function($post){
                $this->deleteImage($post->image);
                $post->forceDelete();
            });
        } else {
            $user->posts()->withTrashed()
                ->update(['author_id' => $selected_user]);
        }
        $user->delete();

        return redirect()
            ->route('backend.users.index')
            ->with('success', 'Your User has been deleted successfully!');
    }

    public function confirmDelete($id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id', '!=', $id)->pluck('name', 'id');
        return view('backend.users.confirm', compact('user', 'users'));
    }
}
