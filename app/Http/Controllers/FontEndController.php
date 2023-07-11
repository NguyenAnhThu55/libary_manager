<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Authors;
use App\Models\User;
use App\Models\SoftDocument;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

use Illuminate\Support\Facades\Mail;

class FontEndController extends Controller
{
    public function index()
    {
        return View('fontend.home');
    }
    public function search_fontend(Request $request)
    {
        $get_input = $request->search;
        $value_option = $request->value_option;

        // get với value = 0 ()
        $get_search = Books::where('books_name', 'like', '%' . $get_input . '%')
            ->orwhere('books_code', 'like', '%' . $get_input . '%')
            ->orwhere('books_price', 'like', '%' . $get_input . '%')
            ->orwhere('authors_name', 'like', '%' . $get_input . '%')
            ->orwhere('publishing_year', 'like', '%' . $get_input . '%')
            ->paginate(10);

        $get_search_1 = Books::where('books_name', 'like', $get_input . '%')
            ->paginate(10);

        $get_search_2 = Books::where('authors_name', 'like', $get_input . '%')
            ->paginate(10);

        // $get_search_3 = Books::where('books_category_id', 'like', $get_input . '%')
        //     ->paginate(10);


        // echo '<pre>'; print_r($get_search);'</pre>';



        $get_search_4 = Books::where('publishing_year', 'like', $get_input . '%')
            ->paginate(10);

        $output = " ";
        if (count($get_search) > 0 && $value_option == 0) {
            $output .= '
            <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body" >
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên Sách</th>
                                <th scope="col">Tác Giả</th>
                                <th scope="col">Xuất Bản</th>
                                <th scope="col">Mã code</th>
                                <th scope="col">Số lượng còn</th>
                              </tr>
                            </thead>
                            <tbody>';
            $i = 0;

            foreach ($get_search as  $key => $search) {
                $i++;
                $output .= '
                                        <tr>
                                            <th scope="row">' . $i . '</th>
                                            ';

                if ($search->books_image == null) {
                    $output .= '
                                                <td>
                                                <img src="public/image/nothumb.jpg" width="40" height="40">
                                            </td>';
                } else {
                    $output .= '
                                                <td>
                                                    <img src="public/image/' . $search->books_image . '" width="40" height="40">
                                                </td>';
                }
                $output .= '
                                            <td>' . $search->books_name . '</td>
                                            <td>' . $search->authors_name . '</td>
                                            <td>' . $search->publishing_year . '</td>
                                            <td>' . $search->books_code . '</td>
                                            <td>' . $search->books_quantity . '</td>
                                            
                                        </tr>
                                        ';
            }

            $output .= '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        ' . $get_search->links() . '
            ';
        }
        // tìm kiếm theo nhan đề 
        elseif (count($get_search) > 0 && $value_option == 1) {
            $output .= '
            <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body" >
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên Sách</th>
                                <th scope="col">Tác Giả</th>
                                <th scope="col">Xuất Bản</th>
                                <th scope="col">Mã code</th>
                                <th scope="col">Số lượng còn</th>
                              </tr>
                            </thead>
                            <tbody>';
            $i = 0;

            foreach ($get_search_1 as  $key => $search_1) {
                $i++;
                $output .= '
                                        <tr>
                                            <th scope="row">' . $i . '</th>
                                            ';

                if ($search_1->books_image == null) {
                    $output .= '
                                                <td>
                                                <img src="public/image/nothumb.jpg" width="40" height="40">
                                            </td>';
                } else {
                    $output .= '
                                                <td>
                                                    <img src="public/image/' . $search_1->books_image . '" width="40" height="40">
                                                </td>';
                }
                $output .= '
                                            <td>' . $search_1->books_name . '</td>
                                            <td>' . $search_1->authors_name . '</td>
                                            <td>' . $search_1->publishing_year . '</td>
                                            <td>' . $search_1->books_code . '</td>
                                            <td>' . $search_1->books_quantity . '</td>
                                            
                                        </tr>
                                        ';
            }

            $output .= '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
            ';
        }
        // tìm kiếm theo tác gải
        elseif (count($get_search) > 0 && $value_option == 2) {
            $output .= '
            <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body" >
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên Sách</th>
                                <th scope="col">Tác Giả</th>
                                <th scope="col">Mã code</th>
                                <th scope="col">Số lượng còn</th>
                              </tr>
                            </thead>
                            <tbody>';
            $i = 0;

            foreach ($get_search_2 as  $key => $search_2) {
                $i++;
                $output .= '
                                        <tr>
                                            <th scope="row">' . $i . '</th>
                                            ';

                if ($search_2->books_image == null) {
                    $output .= '
                                                <td>
                                                <img src="public/image/nothumb.jpg" width="40" height="40">
                                            </td>';
                } else {
                    $output .= '
                                                <td>
                                                    <img src="public/image/' . $search_2->books_image . '" width="40" height="40">
                                                </td>';
                }
                $output .= '
                                            <td>' . $search_2->books_name . '</td>
                                            <td>' . $search_2->authors_name . '</td>
                                            <td>' . $search_2->books_code . '</td>
                                            <td>' . $search_2->books_quantity . '</td>
                                            
                                        </tr>
                                        ';
            }

            $output .= '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
            ';
        }

        elseif (count($get_search) > 0 && $value_option == 4) {

            $output .= '
            <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body" >
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên Sách</th>
                                <th scope="col">Tác Giả</th>
                                <th scope="col">Xuất Bản</th>
                                <th scope="col">Mã code</th>
                                <th scope="col">Số lượng còn</th>
                              </tr>
                            </thead>
                            <tbody>';
            $i = 0;

            foreach ($get_search_4 as  $key => $search_4) {
                $i++;
                $output .= '
                                        <tr>
                                            <th scope="row">' . $i . '</th>
                                            ';

                if ($search_4->books_image == null) {
                    $output .= '
                                                <td>
                                                <img src="public/image/nothumb.jpg" width="40" height="40">
                                            </td>';
                } else {
                    $output .= '
                                                <td>
                                                    <img src="public/image/' . $search_4->books_image . '" width="40" height="40">
                                                </td>';
                }
                $output .= '
                                            <td>' . $search_4->books_name . '</td>
                                            <td>' . $search_4->authors_name . '</td>
                                            <td>' . $search_4->publishing_year . '</td>
                                            <td>' . $search_4->books_code . '</td>
                                            <td>' . $search_4->books_quantity . '</td>
                                            
                                        </tr>
                                        ';
            }

            $output .= '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
            ';
        } else {
            $output .= '<div class="col-12 text-center justify-content-center"><p>Không có Tài liệu này ở thư viện, vui lòng liên hệ để mượn Trung Tâm Học Liệu!</p></div>';
        }
        echo $output;
    }
    public function manager_file()
    {

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'luanvan') {
                $file = SoftDocument::where('soft_document_category', '1')->Limit(10)->get();
            } elseif ($sort_by == 'nienluannganh') {

                $file = SoftDocument::where('soft_document_category', '=', 2)->Limit(10)->get();
            } elseif ($sort_by == 'nienluancoso') {
                $file = SoftDocument::where('soft_document_category', '=', 3)->Limit(10)->get();
            } elseif ($sort_by == 'tapchi') {
                $file = SoftDocument::where('soft_document_category', '=', 4)->Limit(10)->get();
            }
        } else {
            $file = SoftDocument::paginate(5);
        }
        $get_file_pdf = SoftDocument::paginate(5);
        return View('fontend.manager_file')->with('get_file_pdf', $get_file_pdf)
            ->with('file', $file);
    }
    public function detail_file($soft_id)
    {
        $get_detail_pdf = SoftDocument::where('soft_document_id', $soft_id)->get();
        return View('fontend.detail_file')->with('get_detail_pdf', $get_detail_pdf);
    }

    public function auth()
    {
        return view('fontend.auth.register');
    }
    public function login_auth()
    {
        return view('fontend.auth.login_auth');
    }

    public function login(Request $request)
    {
        $user_code = $request->user_code;
        $password = md5($request->password);
        $result = User::where('user_code', $user_code)->where('user_password', $password)->first();
        if ($result) {
            Session::put('user_name', $result->user_name);
            Session::put('user_id', $result->user_id);
            return Redirect::to('/thu-vien-khoa-PTNT');
        } else {
            Session::put("message", "Mật Khẩu hoặc MSSV Không trùng khớp. Vui Lòng Kiểm Tra lại !");
            return Redirect::back();
        }
    }
    public function logout(Request $request)
    {
        Session::put('user_name', null);
        Session::put('user_id', null);
        // Session::delete('user_id');
        // Session::flush();

        return Redirect::to('/thu-vien-khoa-PTNT');
    }

    public function register(Request $request)
    {
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_email'] = $request->user_email;
        $data['user_position'] = $request->user_position;
        $data['user_code'] = $request->user_code;
        $data['user_phone'] = $request->user_phone;
        $data['user_password'] = md5($request->password);
        if ($data['user_password'] === md5($request->password_repeat)) {
            $insert_user = User::insert($data);

            Session::put("message", "Đăng Ký thành công! vui lòng đăng nhập");
            return Redirect::to('/login-auth');
        } else {
            Session::put("message", "Mật Khẩu Không trùng khớp. Vui Lòng Kiểm Tra lại !");
            return Redirect::back();
        }
    }


    public function status()
    {
        return view('fontend.status.status_user');
    }
}
