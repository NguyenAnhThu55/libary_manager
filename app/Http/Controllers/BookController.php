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
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/trang-chu');
        } else {
            return Redirect::to('/')->send();
        }
    }

    public function list_book()
    {
        $this->AuthLogin();
        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();

        $list_books = DB::table('tbl_books')
            ->join('tbl_books_category', 'tbl_books_category.books_category_id', '=', 'tbl_books.books_category_id')
            ->orderBy('tbl_books.books_id', 'desc')->paginate(10);

        $type_book = DB::table('tbl_books_category')->get();
        // echo '<pre>';print_r($qty);echo '</pre>';


        return View('pages.books.list_book')
            ->with('bookCategory', $bookCategory)
            ->with('list_books', $list_books)
            ->with('type_book', $type_book);
    }
    public function detail_book($books_id)
    {
        $this->AuthLogin();
        return View('pages.books.detail_book');
    }

    public function save_book(Request $request)
    {
        $this->AuthLogin();
        $book_code = rand(102345678, 100000000);
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($book_code, $generator::TYPE_STANDARD_2_5, 2, 60);
        $data = array();
        $data['books_name'] = $request->books_name;
        $data['books_code'] = $book_code;
        $data['barcode'] = $barcodes;


        $data['books_quantity'] = $request->books_quantity;
        $data['books_borrow_qty'] = 0;
        $data['books_category_id'] = $request->category_of_book;

        $data['authors_name'] = $request->author_of_book;
        $data['books_price'] = $request->books_price;
        $data['publishing_year'] = $request->publishing_year;
        $data['publishing_company'] = $request->publishing_company;
        $data['books_status'] = $request->books_status;

        $get_image = $request->file('books_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            // hàm cắt đuôi .jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('image'), $new_image);
            $data['books_image'] = $new_image;
            Books::insert($data);
            Session::put('message', 'Thêm Sách thành công');
            return redirect::to('thong-ke-sach');
        } else {
            $data['books_image'] = '';
        }

        Books::insert($data);
        Session::put('message', 'Thêm sách thành công');
        return redirect::to('thong-ke-sach');
    }
    public function edit_book($books_id)
    {
        $this->AuthLogin();

        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();
        $edit_book = Books::where('books_id', $books_id)->get();
        $manager_book = view('pages.books.edit_book')->with('bookCategory', $bookCategory)
            ->with('edit_book', $edit_book);
        return view('layout')->with('pages.books.edit_book', $manager_book);
    }
    public function update_book(Request $request, $books_id)
    {
        $this->AuthLogin();
        $book_code = rand(102345, 100000);
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($book_code, $generator::TYPE_STANDARD_2_5, 2, 60);
        $data = array();
        $data['books_name'] = $request->books_name;
        $data['books_code'] = $request->books_code;
        $data['barcode'] = $barcodes;

        $data['books_quantity'] = $request->books_quantity;
        // $data['books_borrow_qty'] = $request->books_borrow_qty;
        $data['books_category_id'] = $request->category_of_book;
        $data['authors_name'] = $request->author_of_book;
        $data['books_price'] = $request->books_price;
        $data['publishing_year'] = $request->publishing_year;
        $data['publishing_company'] = $request->publishing_company;
        $data['books_status'] = $request->books_status;

        $get_image = $request->file('books_image');
        // echo '<pre>'; print_r($get_image); '</pre>';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            // hàm cắt đuôi .jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('image'), $new_image);
            $data['books_image'] = $new_image;
            Books::where('books_id', $books_id)->update($data);
            Session::put('message', 'Cập nhật Sách thành công');
            return redirect::to('thong-ke-sach');
        }

        Books::where('books_id', $books_id)->update($data);
        Session::put('message', 'Cập nhật Sách thành công');
        return redirect::to('thong-ke-sach');
    }

    public function delete_book($books_id)
    {
        $this->AuthLogin();
        Books::where('books_id', $books_id)->delete();
        Session::put('message', 'Xóa sách thành công');
        return redirect::to('thong-ke-sach');
    }

    public function all_barcode(Request $request)
    {
        $this->AuthLogin();
        $get_barcodes = Books::all();
        return view('pages.books.barcode')->with('get_barcodes', $get_barcodes);
    }

    public function check_type_books(Request $request)
    {
        $get_value = $request->value_type;

        $get_list_book = DB::table('tbl_books')->where('tbl_books.books_category_id', '=', $get_value)
            ->join('tbl_books_category', 'tbl_books_category.books_category_id', '=', 'tbl_books.books_category_id')
            ->orderBy('tbl_books.books_id', 'desc')->get();


        $output = '';
        if (count($get_list_book) > 0) {

            $output .= '<div class="table-responsive" id="show_check_type_book">
                <table id="" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                    <thead class="table-light-borrow">
                        <tr>
                            <th style="width: 20px;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                </div>
                            </th>
                          
                            <th>Tên Sách</th>
                            <th>Hình Ảnh</th>
                            <th>Mã Sách</th>
                            <th>Tên Tác Giả</th>
                            <th>Năm xuất bản</th>
                            <th>Số lượng kho</th>
                          
                            <th style="width: 155px;">Tùy Chọn</th>
                        </tr>
                    </thead>
                
                    
                    <tbody >';
            foreach ($get_list_book as $get) {
                $output .= '
                    <input type="hidden" name="cart_books_id" class="cart_books_id_' . $get->books_id . '" value="' . $get->books_id . '">
                    <input type="hidden" name="cart_books__qty" class="cart_books__qty_' . $get->books_id . '" value="1">';

                if ($get->books_quantity > 0 && $get->books_image != null) {
                    $output .= '
                   
                        <tr>
                            <td>
                                <div class="form-check">
                                    <button class="btn btn-success add-to-cart" name="' . $get->books_id . '"
                                            style="font-size: 10px;
                                            margin-left: -25px;
                                            padding: 4px;"
                                            type="submit">
                                    <i class="fa-solid fa-plus m-1"></i>
                                    </button>
                                </div>
                               
                            </td>
                            <td>
                               
                                ' . $get->books_name . '
                            </td>
                            <td>
                                <img src="' . ('public/image/' . $get->books_image) . '" altwidth="40" height="40">
                            </td>
                            <td>
                               
                               ' . $get->books_code . '
                            </td>
    
                            <td>
                                ' . $get->authors_name . '
                            </td>
                            <td>
                            ' . $get->publishing_year . '
                            </td>
    
                           
                            <td id="borrow_qty">';


                    $total_book = $get->books_quantity  + $get->books_borrow_qty;

                    $output .= '
                                ' . $get->books_quantity . '/' . $total_book . '
    
                            </td>
    
                            <td>
    
                                <a href="' . url('/detail-book/' . $get->books_id) . '" class="action-icon"><i class="far fa-eye"></i></a>
                                <a href="' . url('/edit-book/' . $get->books_id) . '" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                
                            </td>
                        </tr>';
                } elseif ($get->books_quantity > 0 && $get->books_image == null) {
                    $output .= '
                   
                        <tr>
                            <td>
                                <div class="form-check">
                                    <button class="btn btn-success add-to-cart" name="' . $get->books_id . '"
                                            style="font-size: 10px;
                                            margin-left: -25px;
                                            padding: 4px;"
                                            type="submit">
                                    <i class="fa-solid fa-plus m-1"></i>
                                    </button>
                                </div>
                               
                            </td>
                            <td>
                               
                                ' . $get->books_name . '
                            </td>
                            <td>
                                <img src="' . ('public/image/nothumb.jpg') . '" altwidth="40" height="40">
                            </td>
                            <td>
                               
                               ' . $get->books_code . '
                            </td>
    
                            <td>
                                ' . $get->authors_name . '
                            </td>
                            <td>
                            ' . $get->publishing_year . '
                            </td>
    
                           
                            <td id="borrow_qty">';


                    $total_book = $get->books_quantity  + $get->books_borrow_qty;

                    $output .= '
                                ' . $get->books_quantity . '/' . $total_book . '
    
                            </td>
    
                            <td>
    
                                <a href="' . url('/detail-book/' . $get->books_id) . '" class="action-icon"><i class="far fa-eye"></i></a>
                                <a href="' . url('/edit-book/' . $get->books_id) . '" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                
                            </td>
                        </tr>';
                } elseif (count($get_list_book) == 0) {
                    $output .= '
                        <tr>
                            <td>
                               <p>Chưa có Tài Liệu Này</p>
                            </td>
                        </tr>';
                } else {
                    $output .= '
                        <tr>
                            <td>
                               <p>Chưa có Tài Liệu Này</p>
                            </td>
                        </tr>';
                }
            }
            $output .= '</tbody>
                </table>
              
                </div><style>#no_value_type_book{display:none}</style>';
        }
        echo $output;
    }


    public function search_list(Request $request)
    {
        // $get_value_type = $request->value_type_input;
        $get_value_search = $request->value_search_input;
        if ($get_value_search) {

            $list_books = DB::table('tbl_books')
                ->join('tbl_books_category', 'tbl_books_category.books_category_id', '=', 'tbl_books.books_category_id')
                ->where('books_id', 'like', $get_value_search)
                ->orwhere('books_code', 'like', '%' . $get_value_search . '%')
                ->orwhere('books_name', 'like', '%' . $get_value_search . '%')
                ->orwhere('authors_name', 'like', '%' . $get_value_search . '%')
                ->orwhere('books_category_name', 'like', '%' . $get_value_search . '%')
                ->orwhere('publishing_year', 'like', '%' . $get_value_search . '%')
                ->orwhere('publishing_company', 'like', '%' . $get_value_search . '%')
                ->get();
            $output = '';

            if (count($list_books) > 0) {
                $output .= '
                    <div class="table-responsive" id="show-search-list">
                    <table id="" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                        <thead class="table-light-borrow">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                              
                                <th>Tên Sách</th>
                                <th>Hình Ảnh</th>
                                <th>Mã Sách</th>
                                <th>Tên Tác Giả</th>
                                <th>Năm xuất bản</th>
                                <th>Số lượng kho</th>
                              
                                <th style="width: 155px;">Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody  >';
                foreach ($list_books as $list) {
                    $output .= '
                            <input type="hidden" name="cart_books_id" class="cart_books_id_' . $list->books_id . '" value="' . $list->books_id . '">
                            <input type="hidden" name="cart_books__qty" class="cart_books__qty_' . $list->books_id . '" value="1">';
                            if($list->books_image == null){
                                $output .= '
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <button class="btn btn-success add-to-cart" name="' . $list->books_id . '"
                                                style="font-size: 10px;
                                                margin-left: -25px;
                                                padding: 4px;"
                                                type="submit">
                                        <i class="fa-solid fa-plus m-1"></i>
                                        </button>
                                    </div>
                                
                                </td>
    
                                <td>
                                ' . $list->books_name . '
                                </td>
                                <td>
                                <img src="' . ('public/image/nothumb.jpg') . '" altwidth="40" height="40">
                            </td>
    
                            <td>
                               
                               ' . $list->books_code . '
                            </td>
    
                            <td>
                                ' . $list->authors_name . '
                            </td>
                            <td>
                            ' . $list->publishing_year . '
                            </td>
                           
                            <td id="borrow_qty">';


                            }else{
                                $output .= '
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <button class="btn btn-success add-to-cart" name="' . $list->books_id . '"
                                                style="font-size: 10px;
                                                margin-left: -25px;
                                                padding: 4px;"
                                                type="submit">
                                        <i class="fa-solid fa-plus m-1"></i>
                                        </button>
                                    </div>
                                
                                </td>
    
                                <td>
                                ' . $list->books_name . '
                                </td>
                                <td>
                                <img src="' . ('public/image/' . $list->books_image) . '" altwidth="40" height="40">
                            </td>
    
                            <td>
                               
                               ' . $list->books_code . '
                            </td>
    
                            <td>
                                ' . $list->authors_name . '
                            </td>
                            <td>
                            ' . $list->publishing_year . '
                            </td>
                           
                            <td id="borrow_qty">';

                            }
                    

                    $total_book = $list->books_quantity  + $list->books_borrow_qty;

                    $output .= '
                                ' . $list->books_quantity . '/' . $total_book . '
    
                            </td>
    
                            <td>
    
                                <a href="' . url('/detail-book/' . $list->books_id) . '" class="action-icon"><i class="far fa-eye"></i></a>
                                <a href="' . url('/edit-book/' . $list->books_id) . '" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                
                            </td>
                            </tr><style>#no_value_type_book,#show_check_type_book,.back_search-tthl--status{display:none}</style>';
                }
                $output .= '
                                </tbody>
                            </table>
                        </div>
                            ';
            } else {
                $output .= '
                    <div class="table-responsive" id="">
                    <table id="" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                        <thead class="table-light-borrow">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                              
                                <th>Tên Sách</th>
                                <th>Hình Ảnh</th>
                                <th>Mã Sách</th>
                                <th>Tên Tác Giả</th>
                                <th>Năm xuất bản</th>
                                <th>Số lượng kho</th>
                              
                                <th style="width: 155px;">Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody  >
                            <tr>
                                <td colspan="8"><h4>Không tìm thấy dữ liệu này</h4></td>
                            </tr>
    
                        </tbody></table>
                        </div><style>#no_value_type_book,#show_check_type_book,.back_search-tthl--status{display:none}</style>';
            }
        }
        echo $output;
    }
}
