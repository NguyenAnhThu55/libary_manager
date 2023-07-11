<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('pages.users.all_admin')->with(compact('admin'));
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        $get_admin_email = $request->admin_email;
        $user = Admin::where('admin_email',$get_admin_email)->first();
        $user->roles()->detach();
        if($request['user_role']){
           $user->roles()->attach(Role::where('name','Thủ Thư')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Role::where('name','Quản Trị')->first());     
        }
        return redirect()->back();
        
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Role::where('name','user')->first());
        Session::put('message','Thêm quản trị thành công');
        return Redirect::to('/all-users');
    }
}
