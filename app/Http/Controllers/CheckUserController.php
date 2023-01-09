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
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

class CheckUserController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    // hàm đăng ký user
    public function add_user(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_position'] = $request->user_position;
        $data['user_code'] = $request->user_code;
        $data['user_phone'] = $request->user_phone;
        $data['user_email'] = $request->user_email;

        $user_id = User::insertGetId($data);

        Session::put('user_id',$user_id);
        Session::put('user_phone',$request->user_phone);
        Session::put('user_name',$request->user_name);
        Session::put('message','Thêm đọc giả thành công');
        return Redirect('/show-cart-book');
    }

    public function register_user(Request $request){
        $this->AuthLogin();
        return view('pages.checkUser.register_user');
    }

    public function check_user(Request $request){
            $this->AuthLogin();
            $data_input = $request->user_code;
            $get_user=User::where('user_code',$data_input)->get();

            $cart = 0;
            $cart = (Session::get('books_id'));
            // $cart++; //
             $count=Cart::count($cart);
            $output = '';
            if(count($get_user)>0){
                foreach( $get_user as $user ){

                     $output = '<div class="border border-dark p-2">
                            <p class="text-capitalize" style="font-size: 16px;
                            line-height: 25px;">
                                  <span>Tên CB / SV:</span>
                                  <span><b>'.$user->user_name.'</b></span>
                            </p>
        
                            <p class="text-capitalize" style="font-size: 16px;
                            line-height: 25px;">
                                  <span>MSCB / MSSV:</span>
                                  <span><b>'.$user->user_code.'</b></span>
                            </p>
        
                            <p class="text-capitalize" style="font-size: 16px;
                            line-height: 25px;">
                                  <span>SĐT :</span>
                                  <span><b>'.$user->user_phone.'</b></span>
                            </p>

                            <p class="text-capitalize" style="font-size: 16px;
                                line-height: 25px;">
                                  <span>Email:</span>
                                  <span class="text-lowercase"><b>'.$user->user_email.'</b></span>

                                <input type="hidden" name="get_user_id" value="'.$user->user_id.'" />
                                <input type="hidden" name="get_user_name" value="'.$user->user_name.'" />
                                <input type="hidden" name="get_user_phone" value="'.$user->user_phone.'" />
                                <input type="hidden" name="get_user_email" value="'.$user->user_email.'" />
                                <input type="hidden" name="get_user_position" value="'.$user->user_position.'" />
                            </p>
                      </div>';
                      if($user->user_position==1 && $count<4){
                          $output.= '<h6>Nhập Ngày trả sách</h6>
                          <div class="input-group">
                              <input type="text" required name="pay_day" class="form-control form-control-light" id="pay_day">
                              <span class="input-group-text bg-primary border-primary text-white">
                                  <i class="mdi mdi-calendar-range font-13"></i>
                              </span>
                          </div>
    
                          <div class="text-sm-end">
                              <button type="submit" id="add_borrowing_books" name="add_borrow" class="btn btn-danger mb-2">
                                  Mượn Sách
                              </button>
                              
                          </div>
    
                          <script type="text/javascript">
                            flatpickr("#pay_day", {
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                minDate: "today",
                                // người mượn hạn cao nhất là 30 ngày 
                                maxDate: new Date().fp_incr(30)
                            });
                        </script>
                          ';

                      }
                      elseif($user->user_position==2 && $count<6){
                        $output.= '<h6>Nhập Ngày trả sách</h6>
                        <div class="input-group">
                            <input type="text" required name="pay_day" class="form-control form-control-light" id="pay_day1">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
  
                        <div class="text-sm-end">
                            <button type="submit" id="add_borrowing_books" name="add_borrow" class="btn btn-danger mb-2">
                                Mượn Sách
                            </button>
                            
                        </div>
  
                        <script type="text/javascript">
                          flatpickr("#pay_day1", {
                              enableTime: true,
                              dateFormat: "Y-m-d H:i",
                              minDate: "today",
                              // người mượn hạn cao nhất là 60 ngày 
                              maxDate: new Date().fp_incr(60)
                          });
                      </script>
                        ';

                    }else{
                        $output.= '<div style="text-align: center;background-color: #cccc;
                                text-transform: initial;" class="p-1">
                                    <h6 class="text-danger">Với tài khoảng của sinh viên chỉ có thể mượn tối đa 3 cuốn</h6>
                                    <h6 class="text-danger">Với tài khoảng của cán bộ mượn tối đa 5 cuốn</h6>
                                    <h5>Vui Lòng chọn lại số lượng sách</h5></div>';      
                    }

                }
            }else{
                
                $output = '<p class="text-capitalize" style="font-size: 18px;
                                line-height: 32px;">Tài khoảng chưa đăng ký: 
                                <a href="'.url('/register-user').'"><b>Đăng Ký</b></a></p>
                           ';
            }
            echo $output;

    }
    public function list_users(){
        $this->AuthLogin();
        $get_users=User::get();
        return view('pages.users.list_users')->with('get_users',$get_users);
    }

    public function delete_user($user_id){
            $this->AuthLogin();
            User::where('user_id',$user_id)->delete();
            Session::put('message','Xóa Đọc Giả thành công');
            return redirect::to('/list-users');
    }
    public function edit_user($user_id){
        $edit_user =user::where('user_id',$user_id)->get();
        $manager_user = View('pages.users.edit_user')->with('edit_user',$edit_user);
        return View('layout')->with('pages.users.edit_user',$manager_user);
    }

    public function update_user(Request $request,$user_id){
        $this->AuthLogin();
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_position'] = $request->user_position;
        $data['user_phone'] = $request->user_phone;
        $data['user_email'] = $request->user_email;
        $data['user_code'] = $request->user_code;
        user::where('user_id',$user_id)->update($data);
        Session::put('message','Cập Nhật thành công');
        return redirect::to('/list-users');
    }


}

