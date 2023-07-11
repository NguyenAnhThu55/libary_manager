<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Authors; 
use App\Models\BookCategory; 
use Illuminate\Support\Facades\Redirect;

class BookCategoryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function list_BookCategory(){
        $this->AuthLogin();
        $list_BookCategory = BookCategory::orderBy('books_category_name','ASC')->get();
        $manager_BookCategory = View('pages.bookCategory.list_bookCategory')->with('list_BookCategory',$list_BookCategory);
        return View('layout')->with('pages.bookCategory.list_bookCategory', $manager_BookCategory);
    }

    public function save_BookCategory(Request $request){
        $data = array();
        $data['books_category_name'] = $request->books_category_name;
        $data['books_category_status'] = $request->books_category_status;

        BookCategory::insert($data);
        Session::put('message','Thêm Loại sách thành công');
        return redirect::to('/loai-sach');
    }


    public function edit_BookCategory($bookCategory_id){
        $this->AuthLogin();
        $edit_BookCategory = BookCategory::where('books_category_id',$bookCategory_id)->get();
        $manager_BookCategory = View('pages.bookCategory.edit_BookCategory')->with('edit_BookCategory',$edit_BookCategory);
        return View('layout')->with('pages.bookCategory.edit_BookCategory', $manager_BookCategory);
    }

    public function update_BookCategory(Request $request,$bookCategory_id){
        $this->AuthLogin();
        $data = array();
        $data['books_category_name'] = $request->books_category_name;
        $data['books_category_status'] = $request->books_category_status;
        BookCategory::where('books_category_id',$bookCategory_id)->update($data);
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/loai-sach');
    }

    public function delete_BookCategory($bookCategory_id){
        $this->AuthLogin();
        BookCategory::where('books_category_id',$bookCategory_id)->delete();
        Session::put('message','Xóa loại sách thành công');
        return redirect::to('/loai-sach');
    }
}
