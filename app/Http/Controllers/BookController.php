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
use App\Imports\Imports;
use App\Exports\ExcelExports;

use App\Models\BorrowBooks_Detail;
use Illuminate\Support\Facades\Redirect;
use Picqer;


class BookController extends Controller
{   
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
   
    public function list_book(){
        $this->AuthLogin();
        $authors = Authors::orderBy('authors_id', 'DESC')->get();
        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();

        $list_books =DB::table('tbl_books')
        ->join('tbl_authors','tbl_authors.authors_id','=','tbl_books.authors_id')
        ->join('tbl_books_category','tbl_books_category.books_category_id','=','tbl_books.books_category_id')
        ->orderBy('tbl_books.books_id','desc')->get();

    
        // echo '<pre>';print_r($qty);echo '</pre>';

        return View('pages.books.list_book')
        ->with('authors', $authors)
        ->with('bookCategory',$bookCategory)
        ->with('list_books',$list_books);
    }
    public function detail_book($books_slug){
        $this->AuthLogin();
        return View('pages.books.detail_book');
    }
  
    public function save_book(Request $request){
        $this->AuthLogin();
        $book_code = rand(102345678,100000000);
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($book_code, $generator::TYPE_STANDARD_2_5, 2, 60);
        $data = array();
        $data['books_name'] = $request->books_name;
        $data['books_code'] = $book_code;
        $data['barcode'] = $barcodes;

        $data['books_slug'] = $request->books_slug.rand(0,99);

        $data['books_quantity'] = $request->books_quantity;
        $data['books_borrow_qty'] = 0;
        $data['books_category_id'] = $request->category_of_book;
        $data['authors_id'] = $request->author_of_book;
        $data['books_price'] = $request->books_price;
        $data['books_status'] = $request->books_status;

        $get_image = $request->file('books_image');

       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            // hàm cắt đuôi .jpg
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move( public_path('image'),$new_image);
            $data['books_image'] = $new_image;
            Books::insert($data);
            Session::put('message','Thêm Sách thành công');
            return redirect::to('thong-ke-sach');
        }
        $data['books_image'] = '';

        Books::insert($data);
        Session::put('message','Thêm sách thành công');
        return redirect::to('thong-ke-sach');
    }
    public function edit_book($books_slug){
        $this->AuthLogin();
        $authors = Authors::orderBy('authors_id','DESC')->get();
        $bookCategory = BookCategory::orderBy('books_category_id','DESC')->get();
        $edit_book = Books::where('books_slug',$books_slug)->get();
        $manager_book = view('pages.books.edit_book')->with('authors',$authors)->with('bookCategory',$bookCategory)
        ->with('edit_book',$edit_book);
        return view('layout')->with('pages.books.edit_book',$manager_book);
    }
    public function update_book(Request $request,$books_slug){
        $this->AuthLogin();
        $book_code = rand(102345,100000);
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($book_code, $generator::TYPE_STANDARD_2_5, 2, 60);
        $data = array();
        $data['books_name'] = $request->books_name;
        $data['books_code'] = $request->books_code;
        $data['barcode'] = $barcodes;
        $data['books_slug'] = $request->books_slug;

        $data['books_quantity'] = $request->books_quantity;
        // $data['books_borrow_qty'] = $request->books_borrow_qty;
        $data['books_category_id'] = $request->category_of_book;
        $data['authors_id'] = $request->author_of_book;
        $data['books_price'] = $request->books_price;
        $data['books_status'] = $request->books_status;

        $get_image = $request->file('books_image');

       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            // hàm cắt đuôi .jpg
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move( public_path('image'),$new_image);
            $data['books_image'] = $new_image;
            Books::where('books_slug',$books_slug)->update($data);
            Session::put('message','Cập nhật Sách thành công');
            return redirect::to('thong-ke-sach');
        }

        Books::where('books_slug',$books_slug)->update($data);
        Session::put('message','Cập nhật Sách thành công');
        return redirect::to('thong-ke-sach');
    }

    public function delete_book($books_slug){
        $this->AuthLogin();
        Books::where('books_slug',$books_slug)->delete();
        Session::put('message','Xóa sách thành công');
        return redirect::to('thong-ke-sach');
    }

    public function all_barcode(Request $request){
        $this->AuthLogin();
        $get_barcodes = Books::all();
        return view('pages.books.barcode')->with('get_barcodes',$get_barcodes);
    }

   


}
