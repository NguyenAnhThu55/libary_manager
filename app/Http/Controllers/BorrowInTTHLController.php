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
use App\Http\Controllers\URL;

class BorrowInTTHLController extends Controller
{

    public function view_borrow_tthl_detail($borrow_tthl_id)
    {

        $get_info_tthl = Borrowtthl::where('borrow_tthl_id', $borrow_tthl_id)->first();
        return view('pages.borrow_TTHL.detail_borrow')->with('get_info_tthl', $get_info_tthl);
    }
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/trang-chu');
        } else {
            return Redirect::to('/')->send();
        }
    }

    public function list_borrow_tthl()
    {
        $this->AuthLogin();
        $list_user_borrow_tthl = Borrowtthl::orderBy('borrow_tthl_id', 'desc')->get();
        $manager_borrow = view('pages.borrow_TTHL.list_borrow_in_tthl')->with('list_user_borrow_tthl', $list_user_borrow_tthl);
        return view('layout')->with('pages.borrow_TTHL.list_borrow_in_tthl', $manager_borrow);
    }
    public function save_borrowing_tthl(Request $request)
    {
        $this->AuthLogin();
        //insert infor borrow_books_tthl
        $data = array();
        $data['user_name'] = $request->sv_tthl_name;
        $data['ma_sv'] = $request->mssv_tthl_name;
        $data['email_sv'] = $request->email_sv;
        $data['book_name'] = $request->book_tthl_name;
        $data['authors_name'] = $request->authors_tthl_name;
        $data['book_name2'] = $request->book_tthl_name2;
        $data['authors_name2'] = $request->authors_tthl_name2;
        $data['book_name3'] = $request->book_tthl_nam3;
        $data['authors_name3'] = $request->authors_tthl_name3;
        $data['borrow_tthl_status'] = '0';
        $borrow_tthl = Borrowtthl::insert($data);
        Session::put('message', 'Thêm thông tin thành công');
        return Redirect::to('/list-borrow-tthl');
    }

    public function edit_borrow_tthl($borrow_tthl_id)
    {
        $this->AuthLogin();
        $edit_borrow_tthl = Borrowtthl::where('borrow_tthl_id', $borrow_tthl_id)->get();
        $manager_borrow_tthl = View('pages.borrow_TTHL.edit_borrow_tthl')->with('edit_borrow_tthl', $edit_borrow_tthl);
        return View('layout')->with('pages.borrow_TTHL.edit_borrow_tthl', $manager_borrow_tthl);
    }

    public function update_borrow_tthl(Request $request, $borrow_tthl_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['ma_sv'] = $request->ma_sv;
        $data['email_sv'] = $request->email_sv;
        $data['book_name'] = $request->book_name;
        $data['authors_name'] = $request->authors_name;
        $data['book_name2'] = $request->book_name2;
        $data['authors_name2'] = $request->authors_name2;
        $data['book_name3'] = $request->book_name3;
        $data['authors_name3'] = $request->authors_name3;
        $data['borrow_day'] = $request->borrow_day;
        $data['borrow_tthl_status'] = "0";
        Borrowtthl::where('borrow_tthl_id', $borrow_tthl_id)->update($data);
        Session::put('message', 'Cập Nhật thành công');
        return redirect::to('/list-borrow-tthl');
    }

    public function delete_borrow_tthl($borrow_tthl_id)
    {
        $this->AuthLogin();
        Borrowtthl::where('borrow_tthl_id', $borrow_tthl_id)->delete();
        Session::put('message', 'Xóa thông tin thành công');
        return redirect::to('/list-borrow-tthl');
    }
    public function update_borrow_tthl_status(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data_borrow_tthl_status = $request->order_status_tthl;
        $data_order_id_tthl = $request->order_id_tthl;
        $data['borrow_tthl_status'] = $request->order_status_tthl;
        if ($data['borrow_tthl_status'] == 1) {
            // update ngày mượn
            $data['borrow_day'] = Carbon::now()->format('Y-m-d H:i:s');
            $get = Borrowtthl::where('borrow_tthl_id', $data_order_id_tthl)->first();
            $email =  $get->email_sv;
            $title_mail = "No-reply";
            Mail::send('pages.mail.borrowbooktthl_email', ['data' => $data], function ($message) use ($title_mail, $email) {
                $message->to($email)->subject($title_mail);
                $message->from($email, $title_mail);
            });
        } elseif ($data['borrow_tthl_status'] == 2) {
            // ngày trả
            $data['pay_date'] = Carbon::now()->format('Y-m-d H:i:s');
        }

        Borrowtthl::where('borrow_tthl_id', $data_order_id_tthl)->update($data);
    }

    public function subscribe_to_books()
    {

        $get_user = Session::get('user_id');
        if ($get_user) {
            return view('fontend.subscribe_to_books.form_subscribe');
        } else {
            return view('fontend.subscribe_to_books.subscribe_to_book');
        }

        
    }

    public function subscribe_book()
    {
        $get_user = Session::get('user_id');
        if ($get_user) {
            return view('fontend.subscribe_to_books.form_subscribe');
        } else {
            return view('fontend.auth.login_auth');
        }
    }
    public function chose_number(Request $request)
    {
        $data_input = $request->number;
        $output = '';
        if ($data_input == 2) {
            $output = '
            <div class="mb-3">
                <label for="example-palaceholder" class="form-label">Nhập tên Sách (2)</label>
                <input type="text" id="example-palaceholder" name="book_name2" class="form-control" placeholder="placeholder">
            </div>
                <div class="mb-3 ml-5">
                    <label for="example-palaceholder" class="form-label">Nhập tên tác giả Sách (nếu có)</label>
                    <input type="text" id="example-palaceholder" name"authors_tthl_name2" class="form-control" placeholder="placeholder">
                </div>
        ';
        } elseif ($data_input == 3) {
            $output .= '
            <div class="mb-3">
                <label for="example-palaceholder" class="form-label">Nhập tên Sách (2)</label>
                <input type="text" id="example-palaceholder" name="book_tthl_name2" class="form-control" placeholder="placeholder">
            </div>
                <div class="mb-3 ml-5">
                    <label for="example-palaceholder" class="form-label">Nhập tên tác giả Sách (nếu có)</label>
                    <input type="text" id="example-palaceholder" name"authors_tthl_name2" class="form-control" placeholder="placeholder">
                </div>
            <div class="mb-3">
                <label for="example-palaceholder" class="form-label">Nhập tên Sách (3)</label>
                <input type="text" id="example-palaceholder" name="book_tthl_name3" class="form-control" placeholder="placeholder">
            </div>
                <div class="mb-3 ml-5">
                    <label for="example-palaceholder" class="form-label">Nhập tên tác giả Sách (nếu có)</label>
                    <input type="text" id="example-palaceholder" name"authors_tthl_name3" class="form-control" placeholder="placeholder">
                </div> ';
        } elseif ($data_input == 1) {
            $output .= '';
        }
        echo $output;
    }


    public function save_online(Request $request)
    {
        // get user 
        $get_user = Session::get('user_id');
        $infor_user = User::where('user_id', $get_user)->first();
        //insert infor borrow_books_tthl_online
        $data = array();
        $data['user_name'] = $infor_user->user_name;
        $data['ma_sv'] = $infor_user->user_code;
        $data['email_sv'] = $infor_user->user_email;
        $data['book_name'] = $request->book_tthl_name;
        $data['authors_name'] = $request->authors_tthl_name;
        $data['book_name2'] = $request->book_tthl_name2;
        $data['authors_name2'] = $request->authors_tthl_name2;
        $data['book_name3'] = $request->book_tthl_nam3;
        $data['authors_name3'] = $request->authors_tthl_name3;
        $data['borrow_tthl_status'] = '0';
        $borrow_tthl_online = Borrowtthl::insert($data);
        Session::put('message', 'Đăng ký mượn sách thành công! Vui lòng Kiểm tra Email để cập nhật thông tin khi có sách.');
        return Redirect::to('/subscribe-book');
    }

    public function search_borrow_tthl(Request $request)
    {
        $get_value = $request->value_borrow;
        $manage_borrow_books = Borrowtthl::where('borrow_tthl_status', $get_value)->get();
        $output = '<div class="back_search">
            <a href="http://localhost/library-manager/list-borrow-tthl">
                <i class="fa-solid fa-backward"></i>
            </a>
            <b>chưa có dữ liệu</b>
        </div>
        <style>
        #list_borrow_tthl,#manage_borrow_tthl{display:none}
        i.fa-solid.fa-backward{
            font-size: 25px;
    margin-left: 12px;
    margin-right: 14px;
        }
 </style>';
        if ($get_value == 1) {
            // tìm danh sách đã có

            $output .= '

            <a href="http://localhost/library-manager/list-borrow-tthl" title="trở lại" style="display:flex;float: right;">
            <i class="fa-solid fa-backward"></i>
            </a>

         <div class="table-responsive" id="">
             <table class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                 <thead class="table-light-borrow">
                     <tr>
                         <th>#</th>
                         <th>Tên Người Mượn</th>
                         <th>MSSV</th>
                         <th>Ngày đk Mượn</th>
                         <th>Ngày Mượn</th>
                         <th>Ngày Trả</th>
                         <th>Tình Trạng</th>


                         <th style="width: 150px;">Tùy Chọn</th>
                     </tr>
                 </thead>';


            $i = 0;
            $output .= '
                 <tbody>';

            foreach ($manage_borrow_books as $key => $get_value) {

                $i++;

                $output .= '
                         <tr>
                            
                             <td>' . $i . '</td>
                          
                             <td>
                                ' . $get_value->user_name . ' 
                             </td>
                           
                             <td>
                                 ' . $get_value->ma_sv . '
                             </td>

                           
                             <td>
                                ' . $get_value->borrow_registration_date . '
                             </td>

                          
                             <td>
                                 ' . $get_value->borrow_day . '
                             </td>

                           
                             <td>
                                 ' . $get_value->pay_date . '
                             </td>

                           ';
                if ($get_value->borrow_tthl_status == 0) {
                    $output .= '
                                 <td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ</span>
                                 </td>';
                } elseif ($get_value->borrow_tthl_status == 1) {
                    $output .= '
                                 <td><span class="badge bg-danger">Đang Mượn</span></td>';
                } elseif ($get_value->borrow_tthl_status == 2) {
                    $output .= '
                                 <td><span class="badge badge-warning-lighten">Đã Trả</span></td>';
                }


                $output .= '
                             
                            <td>
                            <a href="' . URL('/view-borrow-tthl-detail/' . $get_value->borrow_tthl_id) . '"
                                class="action-icon text-success" title="Xem chi tiết"><i
                                    class="far fa-eye"></i></a>
                            <a href="' . URL('/edit-borrow-tthl/' . $get_value->borrow_tthl_id) . '"
                                title="sửa" class="action-icon text-success"> <i
                                    class="mdi mdi-square-edit-outline"></i></a>
                        </td>
                         </tr>';
            }
            $output .= '
                 </tbody>
             </table>
         </div><style>
                #list_borrow_tthl,#manage_borrow_tthl,.back_search{display:none}
         </style> 
             ';
        } elseif ($get_value == 2) {
            //đã trả
            $output .= '
            <a href="http://localhost/library-manager/list-borrow-tthl" title="trở lại" style="display:flex;float: right;">
            <i class="fa-solid fa-backward"></i>
            </a>
           
        <div class="table-responsive" id="">
            <table class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                <thead class="table-light-borrow">
                    <tr>
                        <th>#</th>
                        <th>Tên Người Mượn</th>
                        <th>MSSV</th>
                        <th>Ngày đk Mượn</th>
                        <th>Ngày Mượn</th>
                        <th>Ngày Trả</th>
                        <th>Tình Trạng</th>


                        <th style="width: 150px;">Tùy Chọn</th>
                    </tr>
                </thead>';


            $i = 0;
            $output .= '
                <tbody>';

            foreach ($manage_borrow_books as $key => $get_value) {

                $i++;

                $output .= '
                        <tr>
                           
                            <td>' . $i . '</td>
                         
                            <td>
                               ' . $get_value->user_name . ' 
                            </td>
                          
                            <td>
                                ' . $get_value->ma_sv . '
                            </td>

                          
                            <td>
                               ' . $get_value->borrow_registration_date . '
                            </td>

                         
                            <td>
                                ' . $get_value->borrow_day . '
                            </td>

                          
                            <td>
                                ' . $get_value->pay_date . '
                            </td>

                          ';
                if ($get_value->borrow_tthl_status == 0) {
                    $output .= '
                                <td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ</span>
                                </td>';
                } elseif ($get_value->borrow_tthl_status == 1) {
                    $output .= '
                                <td><span class="badge bg-danger">Đang Mượn</span></td>';
                } elseif ($get_value->borrow_tthl_status == 2) {
                    $output .= '
                                <td><span class="badge badge-warning-lighten">Đã Trả</span></td>';
                }


                $output .= '
                            
                           <td>
                           <a href="' . URL('/view-borrow-tthl-detail/' . $get_value->borrow_tthl_id) . '"
                               class="action-icon text-success" title="Xem chi tiết"><i
                                   class="far fa-eye"></i></a>
                           <a href="' . URL('/edit-borrow-tthl/' . $get_value->borrow_tthl_id) . '"
                               title="sửa" class="action-icon text-success"> <i
                                   class="mdi mdi-square-edit-outline"></i></a>
                       </td>
                        </tr>';
            }
            $output .= '
                </tbody>
            </table>
        </div><style>
               #list_borrow_tthl,#manage_borrow_tthl,.back_search{display:none}

               
        </style> 
            ';
        }


            echo   $output;
       
    }
}
