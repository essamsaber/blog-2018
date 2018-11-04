<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\UserUpdateProfileRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.home.index');
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();
        $userProfile = true;
        return view('backend.home.profile', compact('user','userProfile'));
    }

    public function updateProfile(UserUpdateProfileRequest $request)
    {
        $request->user()->update($request->all());
        return back()->with('success', 'Profile information has been updated successfully');
    }
}
