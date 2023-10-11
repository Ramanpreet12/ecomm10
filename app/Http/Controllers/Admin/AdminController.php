<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator , Hash;
use App\Models\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){


        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required'
            ];
            $this->validate($request , $rules , $customMessages);

          if (Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])) {
            return redirect()->route('admin.dashboard')->with('success' , 'Admin login successfully');
          }
          else{
            return redirect()->back()->with('error' , 'Invalid Email or Password !');
          }
        } else {
            return view('admin.login');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success' , 'Admin logout successfully');
    }

    public function AdminPassword(Request $request){
        if ($request->isMethod('post')) {
            $rules = [
                'current_pwd' => 'required',
                'new_password' => 'required'
            ];
            $customMessages = [
                'current_pwd.required' => 'Current Password is required',
                'new_password.required' => 'New Password is required'
            ];
            $this->validate($request , $rules , $customMessages);

            $data = $request->all();
           //check current password is correct or not
           if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {

            //match current password and new password
            if ($data['new_password'] == $data['password_confirmation']) {
               Admin::where('id' , Auth::guard('admin')->user()->id)->update([
                'password'=> bcrypt($data['new_password'])
               ]);
               return redirect()->back()->with('success' , 'Password updated successfully');

            } else {
                return redirect()->back()->with('error' , 'New password and confirm password does not match !');
            }
           }else{
            return redirect()->back()->with('error' , 'Current Password is incorrect !');
           }

        } else {
            return view('admin.update_admin_password');
        }
    }

    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
           return "false";
        }

    }

    public function adminDetails(Request $request){
        if ($request->isMethod('post')) {
            // $data = $request->all();
            $data = [];
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric|digits:10'
            ];
            // $customMessages = [
            //     'current_pwd.required' => 'Current Password is required',
            //     'new_password.required' => 'New Password is required'
            // ];
            $this->validate($request , $rules );


            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                if (!is_dir(storage_path("app/public/images/admin_image"))) {
                    mkdir(storage_path("app/public/images/admin_image"), 0775, true);
                }
                Image::make($image)->save(storage_path("app/public/images/admin_image/".$image_name));
                $data['image']= $image_name;
            }

            $data['name']= $request->name;
            $data['mobile'] = $request->mobile;
            Admin::where('id' , Auth::guard('admin')->user()->id)->update($data);
            return redirect()->back()->with('success' , 'Details updated successfully');
        } else{
            return view('admin.update_admin_details');
        }

    }
}
