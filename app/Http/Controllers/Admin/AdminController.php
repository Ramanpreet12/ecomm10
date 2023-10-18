<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator , Hash;
use App\Models\Admin;
use Image;
use App\Http\Requests\AdminRequest;
use App\Models\AdminRole;

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

            //remeber me with cookies
            if (isset($request->remember) && !empty($request->remember)) {
               setcookie('email' ,$request->email , time()+3600 );
               setcookie('password' ,$request->password , time()+3600 );
            } else {
                setcookie('email' , "");
                setcookie('password' , "");
            }

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
    public function index(){
        $subadmins= Admin::whereNot('type','admin')->latest('id')->get();
        return view('admin.subadmins.index')->with(compact('subadmins'));
    }

    public function create(){

        return view('admin.subadmins.create');
    }

    public function store(AdminRequest $request)
    {

        $data = [];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            if (!is_dir(storage_path("app/public/images/admin_image"))) {
                mkdir(storage_path("app/public/images/admin_image"), 0775, true);
            }
            Image::make($image)->save(storage_path("app/public/images/admin_image/".$image_name));
            $data['image']= $image_name;
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password']= bcrypt($request->password);
        $data['mobile'] = $request->mobile;
        $data['type'] = $request->type;
        $data['status'] =1;

        Admin::create($data);
        return redirect()->route('admin.subadmins.index')->with('success' , 'Admin created successfully');
    }

    public function edit($id){

        $subadmin = Admin::find($id);
        return view('admin.subadmins.edit')->with(compact('subadmin'));
    }

    public function update(AdminRequest $request , $id)
    {

        $data = [];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            if (!is_dir(storage_path("app/public/images/admin_image"))) {
                mkdir(storage_path("app/public/images/admin_image"), 0775, true);
            }
            Image::make($image)->save(storage_path("app/public/images/admin_image/".$image_name));
            $data['image']= $image_name;
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password']= bcrypt($request->password);
        $data['mobile'] = $request->mobile;
        $data['type'] = $request->type;
        $data['status'] =1;

        Admin::whereId($id)->update($data);
        return redirect()->route('admin.subadmins.index')->with('success' , 'Admin updated successfully');
    }

    public function updateSubadminStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status=='Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id' , $request->subadmin_id)->update(['status' => $status]);
            return response()->json(['status' => $status , 'subadmin_id' => $request->subadmin_id]);
        }
    }

    public function delete($id)
    {
        Admin::whereId($id)->delete();
         return redirect()->route('admin.subadmins.index')->with('success' , 'Subadmin deleted successfully');
    }


    // Update subadmins roles
    public function editSubadminRoles(Request $request ,$id){
            $subadmin  = Admin::find($id);
            $get_admin_roles = AdminRole::where('subadmin_id' , $id)->get();
        return view('admin.subadmins.update_roles')->with(compact('subadmin' , 'get_admin_roles'));

    }


    // Update subadmins roles
    public function updateSubadminRoles(Request $request ,$id){

        $existing_admin_roles = AdminRole::where('subadmin_id' , $id)->delete();

        $data = $request->all();
        // dd($data);
        foreach ($data as $key => $value) {

            if (isset($value['view'])) {
                $view = $value['view'];
            }
            else{
                $view= 0;
            }

            if (isset($value['edit'])) {
                $edit = $value['edit'];
            }
            else{
                $edit= 0;
            }

            if (isset($value['full'])) {
                $full = $value['full'];
            }
            else{
                $full= 0;
            }

        }


        // if (isset($request->cms_page['view'])) {
        //   $cms_page_view = $request->cms_page['view'];
        // }
        // else{
        //     $cms_page_view = 0;
        // }

        // if (isset($request->cms_page['edit'])) {
        //     $cms_page_edit = $request->cms_page['edit'];
        // }
        // else{
        //       $cms_page_edit = 0;
        // }

        // if (isset($request->cms_page['full'])) {
        //     $cms_page_full = $request->cms_page['full'];
        // }
        // else{
        //       $cms_page_full = 0;
        // }

         $admin_roles =  AdminRole::create([
            'subadmin_id' => $id,
            'module' => $key,
            'view_access' => $view,
            'edit_access' => $edit,
            'full_access' => $full,
          ]);
          if ($admin_roles) {
            return redirect()->back()->with('success' , 'Subadmin role updated successfully');
          } else {
            return redirect()->back()->with('error' , 'Something went wrong');
          }

    }

}
