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
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use App\Models\BorrowBooks_Detail;
use App\Models\BorrowBooks;
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
        //total
        $books = Books::all()->sum('books_quantity');
        $total_admin = Admin::all()->count();
        $borrow = BorrowBooks::where('borrow_books_status','=','1')->count();
        $user = User::all()->count();
        $violations = BorrowBooks::orwhere('borrow_books_status','=','4')->orwhere('borrow_books_status','=','5')->count();
        return view('pages.home')->with(compact('books','violations','borrow','user','total_admin'));
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

    public function view_profile(){
        $admin_id = Session::get('admin_id');


        $get_profile = DB::table('tbl_admin')->where('admin_id','=',$admin_id)
        ->join('admin_role','tbl_admin.admin_id','=','admin_role.admin_admin_id')
        ->join('tbl_roles','admin_role.role_id_roles', '=','tbl_roles.id_roles')
        ->get();
        // ->get();
        return view('pages.profile.view_profile')->with('get_profile',$get_profile);
    }

    public function edit_profile($profiles_id){
        $this->AuthLogin();

        $edit_profile = Admin::where('admin_id',$profiles_id)
        ->join('admin_role','tbl_admin.admin_id','=','admin_role.admin_admin_id')
        ->join('tbl_roles','admin_role.role_id_roles', '=','tbl_roles.id_roles')->get();
        $manager_profile = view('pages.profile.edit_profile')
            ->with('edit_profile', $edit_profile);
        return view('layout')->with('pages.profile.edit_profile', $manager_profile);
      
    }
    public function update_profile(Request $request, $profiles_id)
    {
        $this->AuthLogin();
       
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_email'] = $request->admin_email;
        $data['admin_phone'] = $request->admin_phone;
       
        $get_image = $request->file('admin_image');
      
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            // hàm cắt đuôi .jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('image'), $new_image);
            $data['admin_image'] = $new_image;

            // echo '<pre>'; print_r($data); '</pre>';
           Admin::where('admin_id', $profiles_id)->update($data);
            Session::put('message', 'Cập nhật Sách thành công');
            return redirect::to('/view-profile');
        }

        Admin::where('admin_id', $profiles_id)->update($data);
            Session::put('message', 'Cập nhật Sách thành công');
            return redirect::to('/view-profile');
        // echo '<pre>'; print_r($data); '</pre>';
    }


}
