<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;

class FrontendUserProfileController extends Controller
{
    //
    public function userdashboard()
    {
        // muon dung Auth:: thi phai use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function userprofile()
    {
        $user = Auth::user();
        return view('frontend.profile.index', compact('user'));
    }

    // Trong Laravel, khi một yêu cầu HTTP được gửi đến ứng dụng, Laravel sẽ tự động tạo một đối tượng Request đại diện cho yêu cầu đó. Đối tượng Request chứa thông tin về các thông số của yêu cầu như tham số URL, các trường dữ liệu POST, phương thức yêu cầu, tiêu đề, và nhiều thông tin khác.
    public function userprofileupdate(Request $request)
    {
        //validate() của đối tượng $request để kiểm tra và xác nhận dữ liệu đầu vào từ người dùng.
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg'
        ]);
        //dd($user, $request->all());
        // user User:: thi import model User
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

        return redirect()->route('user.profile')->with($notification);

    }

    public function userpasswordchange()
    {
        $user = Auth::user();
        return view('frontend.profile.changepassword', compact('user'));
    }

    public function userpasswordupdate(Request $request)
    {
        // input('current_password'): Đây là phương thức của đối tượng $request để truy cập vào giá trị của một trường dữ liệu trong yêu cầu.
        //$request->input('current_password') sẽ trả về giá trị của trường current_password trong yêu cầu hiện tại. 
        $current_password = $request->input('current_password');
        $new_password = $request->input('password');

        //findOrFail() là một phương thức trong Laravel Eloquent ORM (Object-Relational Mapping) 
        //sử dụng để tìm kiếm một bản ghi dựa trên một điều kiện cung cấp. If found, method return bản ghi đó.Else can't found, phương thức findOrFail() sẽ ném ra một ngoại lệ ModelNotFoundException.
        //lấy ID của người dùng đang được xác thực qua Auth::user()->id, sau đó use method findOrFail() trên model User để find bản ghi người dùng với ID tương ứng. Nếu người dùng exist, bản ghi người dùng sẽ được gán cho biến $user. Tuy nhiên, nếu không tìm thấy bản ghi, Laravel sẽ ném ra một ngoại lệ ModelNotFoundException.
        $user = User::findOrFail(Auth::user()->id);

        //Hash::check(): Đây là một phương thức của Laravel's Hashing Facade (Hash). Sử dụng để kiểm tra xem một giá trị có khớp với một giá trị đã được hash hay không. 
        // Hash::check() nhận vào 2 tham số: giá trị ban đầu (chưa được hash) và giá trị đã được hash. Nó sẽ so sánh hai giá trị này và trả về true nếu chúng khớp, ngược lại trả về false.
        if (Hash::check($current_password, $user->password)) {
            // nếu dk đúng => hash password muốn đổi và lưu thành password của user

            $user->password = Hash::make($new_password);
            // update password mới đổi vào bảng 
            $user->update([
                'password' => $user->password,
            ]);

            //Khi gọi Auth::logout(), Laravel sẽ xóa thông tin xác thực của người dùng, đồng thời hủy bỏ phiên đăng nhập hiện tại. Điều này có nghĩa là người dùng sẽ không còn được coi là đang được xác thực và không có quyền truy cập vào các tài nguyên yêu cầu xác thực
            Auth::logout();

            $notification = [
                'message' => 'Password Updated Successfully!!!',
                'alert-type' => 'success'
            ];
            return redirect()->route('user.logout')->with($notification);
        } else {
            $notification = [
                'message' => 'Please provide valid password',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.change.password')->with($notification);
        }
    }



    public function userlogout()
    {
        Auth::logout();
        $notification = [
            'message' => 'Logout Successfull',
            'alert-type' => 'success',
        ];
        return redirect()->route('login')->with($notification);
    }


}