<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  trả về một đối tượng "Admin" có khóa chính (primary key) là 1.
        $adminData = Admin::find(1);
        //n tạo một mảng liên kết với khóa là "adminData" và giá trị là giá trị của biến $adminData. Mảng này có thể được truyền vào hàm view() trong Laravel để truyền dữ liệu từ controller sang view.
        return response()->view('admin.Profile.index', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $adminData = Admin::find(1);
        $editData = Admin::find(1);
        return view('admin.Profile.edit', compact('editData', 'adminData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * //@return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        // trả về một đối tượng Illuminate\Http\UploadedFile đại diện cho tệp tin đã được tải lên từ người dùng
        if ($request->file('image')) {
            $image_file = $request->file('image');
            if ($data->profile_photo_path) {
                @unlink(public_path('upload/admin_images' . $data->profile_photo_path));
            }
            $filename = date('YmdHi') . '.' . $image_file->getClientOriginalExtension();
            $image_file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ];


        return redirect()->route('profile.index')->with($notification);
    }

    public function AdminPasswordChange()
    {
        $adminData = Admin::find(1);
        return view('admin.Profile.change_password', compact('adminData'));
    }

    public function AdminPasswordUpdate(AdminPasswordUpdateRequest $request)
    {

        $current_password = $request->input('current_password');
        $new_password = $request->input('password');

        $admin = Admin::find(1);
        if (Hash::check($current_password, $admin->password)) {
            $admin->password = Hash::make($new_password);
            $admin->update([
                'password' => $admin->password,
            ]);

            Auth::logout();

            $notification = [
                'message' => 'Password Updated Successfully!!!',
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.logout')->with($notification);
        } else {
            $notification = [
                'message' => 'Please provide valid password',
                'alert-type' => 'error'
            ];
            return response()->redirect()->route('admin.change.password')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}