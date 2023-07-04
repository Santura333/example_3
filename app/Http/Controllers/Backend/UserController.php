<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
//use Image;
use Illuminate\Support\Facades\Auth;

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
        $users = User::latest()->get();
        return view('admin.User.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * //@return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //tham so cua function la $user nen compact('user') chay duoc
        return view('admin.User.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->profile_photo_path != 'default.jpg') {
            @unlink(public_path('storage/profile-photos/' . $user->profile_photo_path));
        }
        $user->delete();

        $notification = [
            'message' => '$category Deleted Successfully!!!',
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
    // public function update(UserStoreRequest $request, User $user)
    // {
    //     if ($request->file('profile_photo_path')) {
    //         if ($user->profile_photo_path != 'default.jpg') {
    //             unlink($user->profile_photo_path);
    //         }
    //         $upload_location = 'upload/user/';
    //         $file = $request->file('proflie_photo_path');
    //         $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
    //         // Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
    //         $save_url = $upload_location . $name_gen;

    //         $user->update([
    //             'name' => $request->input('name'),
    //             'email' => $request->input('email'),
    //             'phone_number' => $request->input('phone_number'),
    //             'profile_photo_path' => $save_url
    //             thu cho 'phone_number' 1 gia tri luon, khoi lay tu input xem thu
    //         ]);
    //     } else {
    //         $user->update([
    //             'name' => $request->input('name'),
    //             'email' => $request->input('email'),
    //             'phone_number' => $request->input('phone_number')
    //             // 'photo_profile_path' => $save_url
    //             //    kiem tra lai 'phone_number' + ham update([....])
    //         ]);
    //     }

    //     $notification = [
    //         'message' => 'User Updated Successfully!!!',
    //         'alert-type' => 'info'
    //     ];

    //     return redirect()->route('user.index')->with($notification);
    // }

    public function store(UserStoreRequest $request)
    {

        if ($request->file('profile_photo_path')) {
            $upload_location = 'upload/user/';
            $file = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            // Image::make($file)->resize(600, 600)->save($upload_location . $name_gen);
            $save_url = $upload_location . $name_gen;

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'profile_photo_path' => $save_url
            ]);
        } else {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
            ]);
        }

        $notification = [
            'message' => 'User Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.index')->with($notification);
    }

    public function update(UserStoreRequest $request)
    {
        //dd($request->all());
        //validate() của đối tượng $request để kiểm tra và xác nhận dữ liệu đầu vào từ người dùng.
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg'
        ]);
        //dd($user, $request->all());
        // use User:: thi import model User
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;


        // Khi người dùng tải lên một tệp tin thông qua một trường <input type="file"> trong biểu mẫu, Laravel sẽ tự động tạo một đối tượng UploadedFile để đại diện cho tệp tin đó. Phương thức $request->file('image') giúp chúng ta truy cập đối tượng UploadedFile tương ứng với trường "image" trong yêu cầu. 
        if ($request->file('image')) {
            $image_file = $request->file('image');

            // nếu $data có tồn tại thuộc tính profile_photo_path từ trước thì xóa cái value thuộc tính đó
            if ($data->profile_photo_path) {
                // public_path() là một hàm trong Laravel để trả về đường dẫn tới thư mục gốc của ứng dụng.
                // 'storage/profile-photos/' . $data->profile_photo_path là đường dẫn tới tệp tin hình ảnh của hồ sơ người dùng.
                // Hàm unlink() là một hàm PHP được sử dụng để xóa một tệp tin =>  xóa tệp tin hình ảnh của hồ sơ người dùng từ đường dẫn đã chỉ định.
                @unlink(public_path('storage/profile-photos/' . $data->profile_photo_path));
            }

            // date('YmdHi') sẽ trả về một chuỗi đại diện cho ngày và giờ hiện tại theo định dạng "YmdHi" (ví dụ: 202204261530), tạo ra một tên tệp tin duy nhất dựa trên thời gian hiện tại
            // $image_file->getClientOriginalExtension() trả về phần mở rộng (extension) của tệp tin gốc. Ví dụ: nếu tệp tin gốc có tên là "image.jpg", getClientOriginalExtension() sẽ trả về "jpg".
            // Dòng mã kết hợp cả hai thành một chuỗi tên tệp tin mới với định dạng "YmdHi.extension", ví dụ: "202204261530.jpg".
            $filename = date('YmdHi') . '.' . $image_file->getClientOriginalExtension();
            // Đoạn mã trên sẽ di chuyển tệp tin hình ảnh đến thư mục storage/profile-photos trong thư mục gốc của ứng dụng, và sử dụng tên tệp tin mới đã tạo trước đó.
            // Hàm move() trong Laravel được sử dụng để di chuyển tệp tin từ vị trí hiện tại đến vị trí mới. Đây là một phương thức của đối tượng UploadedFile, cho phép chúng ta thực hiện việc di chuyển và lưu trữ tệp tin tải lên.
            $image_file->move(public_path('storage/profile-photos'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.index')->with($notification);
    }




}