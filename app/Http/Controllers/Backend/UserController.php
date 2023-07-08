<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
//use Image;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminData = Admin::find(1);
        $users = User::latest()->get();
        return view('admin.User.index', compact('users', 'adminData'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * //@return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $adminData = Admin::find(1);
        $userEdit = $user;
        //tham so cua function la $user nen compact('user') chay duoc
        return view('admin.User.edit', compact('userEdit', 'adminData'));
    }

    public function destroy(User $user)
    {
        if ($user->profile_photo_path != 'default.jpg') {
            @unlink(public_path('storage/profile-photos/' . $user->profile_photo_path));
        }
        $user->delete();

        $notification = [
            'message' => 'User Deleted Successfully!!!',
            'alert-type' => 'warning'
        ];

        return redirect()->route('user.index')->with($notification);

    }

    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * //@return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg'
        ]);
        var_dump($request->image);
        //dd($user, $user->all());
        // tim user trong bảng users  theo id rồi gán thông tin user đó vào biên $data
        // $data = User::findOrFail(Auth::user()->id);
        //$data = User::findOrFail(User::find($user->id));
        $data = $user;
        // lưu các value từ user vào $data 
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;


        if ($request->file('image')) {

            $image_file = $request->file('image');
            if ($data->profile_photo_path) {
                @unlink(public_path('storage/profile-photos/' . $data->profile_photo_path));
            }
            $filename = date('YmdHi') . '.' . $image_file->getClientOriginalExtension();
            $image_file->move(public_path('storage/profile-photos'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.index')->with($notification);
        //admin.User.index


    }


}