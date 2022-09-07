<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //
    protected UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function show($id)
    {
        return view('user.profile')->with('user', $this->userService->find($id));
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', $id);
    }

    public function updateInfo(Request $request)
    {
        $res = $this->userService->updateInfo(
            Auth::user()->id,
            $request->input('fullname'),
            $request->input('address'),
            $request->input('dob')
        );

        return redirect()->route('user.edit', Auth::user()->id)->with('msg', $res['message']);
    }

    public function updateImg(Request $request)
    {
        $image = '';
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            if (!file_exists(storage_path('public/image/avatar/' . $filename))) {
                $file->move(public_path('image/avatar'), $filename);
            }
            $image = $filename;
        }
        $res = $this->userService->updateImg(Auth::user()->id, $image);
        return redirect()->route('user', Auth::user()->id)->with('msg', $res['message']);
    }
}
