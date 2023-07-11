<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register_auth(){
        return View('pages.custom_auth.register_auth');
    }

    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_phone = $data['admin_phone'];
        $admin->save();
        return redirect('/trang-chu')->with('message',"Đăng Ký Thành Công");
    }

    public function validation($request){
        return $this->validate($request,[
            'admin_name'=> 'required|max:255',
            'admin_email'=> 'required|email|max:255',
            'admin_password'=> 'required|max:255',
            'admin_phone'=> 'required|max:11',
        ]);

    }
}
