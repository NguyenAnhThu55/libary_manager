<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Authors; 
use App\Models\BookCategory;
use App\Models\BorrowBooks;
use App\Models\BorrowBooks_Detail;
use App\Models\Books;
use App\Models\Borrowtthl;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class BorrowInTTHLController extends Controller
{
   
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function list_borrow_tthl(){
        $this->AuthLogin();
        $list_user_borrow_tthl = Borrowtthl::orderBy('borrow_tthl_id','desc')->get();
        $manager_borrow = view('pages.borrow_TTHL.list_borrow_in_tthl')->with('list_user_borrow_tthl',$list_user_borrow_tthl);
        return view('layout')->with('pages.borrow_TTHL.list_borrow_in_tthl',$manager_borrow);
    }
    public function save_borrowing_tthl(Request $request){  
        $this->AuthLogin();
        //insert infor borrow_books_tthl
        $data = array();
        $data['user_name'] = $request->sv_tthl_name;
        $data['ma_sv'] = $request->mssv_tthl_name;
        $data['email_sv'] = $request->email_sv;
        $data['book_name'] = $request->book_tthl_name;
        $data['authors_name'] = $request->authors_tthl_name;
        $data['borrow_tthl_status'] = '0';
        $borrow_tthl = Borrowtthl::insert($data);
        Session::put('message','Thêm thông tin thành công');
        return Redirect::to('/list-borrow-tthl');
    }

    public function edit_borrow_tthl($borrow_tthl_id){
        $this->AuthLogin();
        $edit_borrow_tthl =Borrowtthl::where('borrow_tthl_id',$borrow_tthl_id)->get();
        $manager_borrow_tthl = View('pages.borrow_TTHL.edit_borrow_tthl')->with('edit_borrow_tthl',$edit_borrow_tthl);
        return View('layout')->with('pages.borrow_TTHL.edit_borrow_tthl', $manager_borrow_tthl);
    }

    public function update_borrow_tthl(Request $request,$borrow_tthl_id){
        $this->AuthLogin();
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['ma_sv'] = $request->ma_sv;
        $data['email_sv'] = $request->email_sv;
        $data['book_name'] = $request->book_name;
        $data['authors_name'] = $request->authors_name;
        $data['borrow_day'] = $request->borrow_day;
        $data['borrow_tthl_status'] = $request->borrow_tthl_status;
        Borrowtthl::where('borrow_tthl_id',$borrow_tthl_id)->update($data);
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/list-borrow-tthl');

    }
   
    public function delete_borrow_tthl($borrow_tthl_id){
        Borrowtthl::where('borrow_tthl_id',$borrow_tthl_id)->delete();
        Session::put('message','Xóa thông tin thành công');
        return redirect::to('/list-borrow-tthl');
    }
    public function update_borrow_tthl_status(Request $request,$borrow_tthl_id){
        $this->AuthLogin();
        $data = array();
        $data['borrow_tthl_status'] = $request->borrow_tthl_status;
        Borrowtthl::where('borrow_tthl_id',$borrow_tthl_id)->update($data);
        if($data['borrow_tthl_status']==1){
            $get = Borrowtthl::where('borrow_tthl_id',$borrow_tthl_id)->first();
            $email =  $get->email_sv;
             $title_mail = "Nhắc Nhở Đã Có Sách";
                Mail::send('pages.mail.borrowbooktthl_email',['data'=>$data],function($message) use($title_mail,$email){
                $message->to($email)->subject($title_mail);
                $message->from($email,$title_mail);
            });
        }
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/list-borrow-tthl');
           

		
		
    }
}
