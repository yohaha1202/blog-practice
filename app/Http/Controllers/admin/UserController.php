<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin/personal/edit');
    }

    public function update(Request $request )
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'introduction' => 'required|string'
        ]);

        if(!empty($request->password)){
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);
        }

        $file_name = Auth::User()->photo;

        if(!empty($request->photo)){

            if (file_exists(public_path().'/images/'.Auth::User()->photo)) {
                unlink(public_path().'/images/'.Auth::User()->photo);
            }

            $file = $request->photo;
            $extension = $file->getClientOriginalExtension();
            $file_name = strval(time()).str_random(5).'.'.$extension;
            $destination_path = public_path().'/images/';

            $file->move($destination_path, $file_name);
        }

        if (!empty($request->password)){
            User::where('id', Auth::User()->id)->update([
                'name' => $request->name,
                'photo' => $file_name,
                'password' => Hash::make($request->password),
                'introduction' => $request->introduction
            ]);
        } else {
            User::where('id', Auth::User()->id)->update([
                'name' => $request->name,
                'photo' => $file_name,
                'introduction' => $request->introduction
            ]);
        }

        return redirect('admin/personal')->with('alert', '修改成功!');
    }
}
