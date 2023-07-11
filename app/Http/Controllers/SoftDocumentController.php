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
use App\Models\SoftDocument;
use App\Imports\Imports;
use App\Exports\ExcelExports;

use App\Models\BorrowBooks_Detail;
use Illuminate\Support\Facades\Redirect;

class SoftDocumentController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }

    public function list_soft(){
        $this->AuthLogin();
        $get_soft = SoftDocument::get();
        return view('pages.softDocument.list_soft')->with('get_soft', $get_soft);
    }
    
    public function save_soft(Request $request){
        $this->AuthLogin();
        $data = array();
        $soft_code = rand(123456,100000);
        $data['soft_document_name'] = $request->soft_name;
        $data['soft_document_desc'] = $request->soft_desc;
        $data['soft_document_authors'] = $request->soft_authors;
        $data['soft_document_code'] = $soft_code;
        $data['soft_document_status'] = $request->soft_status;
        $data['soft_document_category'] = $request->soft_document_category;
        
        SoftDocument::insert($data);
        Session::put('message','Thêm sách thành công');
        return redirect::to('/list-soft');
    }
    
    public function edit_soft($soft_id){
        $this->AuthLogin();
        $edit_book_soft = SoftDocument::where('soft_document_id',$soft_id)->get();
        $manager_book_soft = view('pages.softDocument.edit_soft')
        ->with('edit_book_soft',$edit_book_soft);
        return view('layout')->with('pages.softDocument.edit_soft',$manager_book_soft);
    }
    public function update_soft(Request $request,$soft_id){
        $this->AuthLogin();
        $data = array();
        $data['soft_document_name'] = $request->soft_name;
        $data['soft_document_desc'] = $request->soft_desc;
        $data['soft_document_authors'] = $request->soft_authors;
        $data['soft_document_code'] = $request->soft_code;
        $data['soft_document_status'] = $request->soft_status;
        $data['soft_document_category'] = $request->soft_document_category;
        SoftDocument::where('soft_document_id',$soft_id)->update($data);
        Session::put('message','Cập Nhật Tài Liệu thành công');
        return redirect::to('/list-soft');
    }

    public function delete_soft($soft_id){
        $this->AuthLogin();
         SoftDocument::where('soft_document_id',$soft_id)->delete();
        Session::put('message','Xóa sách thành công');
         return redirect::to('/list-soft');
    }
}
