<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Authors; 
use App\Models\BookCategory; 
use App\Models\Books;
use App\Models\Admin;
use App\Models\BorrowBooks_Detail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function login(){
        return view('pages.login');
    }
    public function index(){
        $this->AuthLogin();
        return view('pages.home');
    }

    public function admin_login(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/trang-chu');
        }else{
            Session::put("message","Mật Khẩu hoặc Email Không trùng khớp. Vui Lòng Kiểm Tra lại !");
            return Redirect::back();
        }
       
    }
    public function admin_logout(Request $request){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/');
    }

    public function search(Request $request){
        $keyword = $request->keywords_submit;
        $authors = Authors::orderBy('authors_id', 'DESC')->get();
        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();

        $search_book = Books::where('books_code',$keyword)->orwhere('books_name','like','%'.$keyword.'%')->orwhere('books_name','like','%__'.$keyword.'__%')
        ->orwhere('books_name','like',$keyword.'__%'.$keyword)->get();
        return View('pages.books.search')
        ->with('authors', $authors)
        ->with('bookCategory',$bookCategory)
        ->with('search_book',$search_book);
    }
}
