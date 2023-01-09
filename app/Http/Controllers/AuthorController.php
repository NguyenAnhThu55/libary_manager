<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Authors; 
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function list_authors(){
        $this->AuthLogin();
        $list_authors = Authors::get();
        $manager_authors = View('pages.authors.auth')->with('list_authors',$list_authors);
        return View('layout')->with('pages.authors.auth', $manager_authors);
    }

    public function save_authors(Request $request){
        $data = array();
        $data['authors_name'] = $request->authors_name;

        Authors::insert($data);
        Session::put('message','Thêm tên tác giả thành công');
        return redirect::to('/tac-gia');
    }
    public function edit_authors($authors_id){
        $edit_authors =Authors::where('authors_id',$authors_id)->get();
        $manager_authors = View('pages.authors.edit_authors')->with('edit_authors',$edit_authors);
        return View('layout')->with('pages.authors.edit_authors', $manager_authors);
    }

    public function update_authors(Request $request,$authors_id){
        $data = array();
        $data['authors_name'] = $request->authors_name;
        DB::table('tbl_authors')->where('authors_id',$authors_id)->update($data);
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/tac-gia');
    }
    public function delete_authors($authors_id){
        Authors::where('authors_id',$authors_id)->delete();
        Session::put('message','Xóa tên tác giả thành công');
        return redirect::to('/tac-gia');
    }
}
