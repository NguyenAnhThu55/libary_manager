<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Authors; 
use App\Models\majors; 
use Illuminate\Support\Facades\Redirect;
class majorsController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function list_majors(){
        $this->AuthLogin();
        $list_majors = majors::orderBy('majors_id','DESC')->get();
        $manager_majors = View('pages.majors.list_majors')->with('list_majors',$list_majors);
        return View('layout')->with('pages.majors.list_majors', $manager_majors);
    }

    public function save_majors(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['majors_name'] = $request->majors_name;

        majors::insert($data);
        Session::put('message','Thêm Khoa Trực Thuộc thành công');
        return redirect::to('/khoa-truc-thuoc');
    }


    public function edit_majors($majors_id){
        $this->AuthLogin();
        $edit_majors = majors::where('majors_id',$majors_id)->get();
        $manager_majors = View('pages.majors.edit_majors')->with('edit_majors',$edit_majors);
        return View('layout')->with('pages.majors.list_majors', $manager_majors);
    }

    public function update_majors(Request $request,$majors_id){
        $this->AuthLogin();
        $data = array();
        $data['majors_name'] = $request->majors_name;
        majors::where('majors_id',$majors_id)->update($data);
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/khoa-truc-thuoc');
    }

    public function delete_majors($majors_id){
        $this->AuthLogin();
        majors::where('majors_id',$majors_id)->delete();
        Session::put('message','Xóa danh mục khoa thành công');
        return redirect::to('/khoa-truc-thuoc');
    }
    
}
