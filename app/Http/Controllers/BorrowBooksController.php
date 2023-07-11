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
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;

class BorrowBooksController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function save_borrowing(Request $request){  
        $this->AuthLogin();
        //insert infor borrow_books
        // $get_user_postion = User::where('user_id',$request->get_user_id)->get('user_position');
        // echo $get_user_postion;

        $data = array();
        $data['user_id'] = $request->get_user_id;
        $data['borrow_books_status'] = '0';
        $data['pay_day'] =  $request->pay_day;
        $borrow = BorrowBooks::insertGetId($data);

        // get author
        $get_author = DB::table('tbl_books')->get();

        foreach($get_author as $author){
            $authors_name = $author->authors_name; 
        }
        // get categoty books
        $get_category = DB::table('tbl_books')->join('tbl_books_category','tbl_books_category.books_category_id','=','tbl_books.books_category_id')->get();
        foreach($get_category as $category){
            $category_id = $category->books_category_id;
            $categorys_name = $category->books_category_name; 
        }
        // echo'<pre>';print_r($get_author);'</pre>';

        //insert infor borrow_books_details
        $content = Cart::content();

        // echo '<pre>';print_r($content);'</pre>';

        foreach($content as $v_content){
            $data_detail = array();
            $data_detail['borrow_book_id'] = $borrow;
            $data_detail['book_id'] = $v_content->id;
            $data_detail['book_name'] = $v_content->name;
            $data_detail['book_price'] = $v_content->price;
            $data_detail['book_borrow_qty'] = $v_content->qty;
        
            // $data_detail['authors_id'] = $authors;
            $data_detail['authors_name'] = $authors_name;
            // 

            $data_detail['category_id'] = $category_id;
            $data_detail['category_name'] = $categorys_name;

            $data_detail['user_id'] = $request->get_user_id;
            $data_detail['user_name'] = $request->get_user_name;
            $data_detail['user_phone'] = $request->get_user_phone;
            $data_detail['user_email'] = $request->get_user_email;
           
           
            $borrow_detail = BorrowBooks_Detail::insert($data_detail);
        }   
        
        Cart::destroy();
        return Redirect::to('manage-borrow');
    }

    public function manage_borrow(Request $request){
        $this->AuthLogin();
        $borrowing = BorrowBooks::get();

        $manage_borrow_books =DB::table('tbl_borrow_books')
        ->join('tbl_users','tbl_users.user_id','=','tbl_borrow_books.user_id')
        ->select('tbl_borrow_books.*','tbl_users.*')
        ->orderBy('tbl_borrow_books.borrow_books_id','desc')->get();

        //  echo '<pre>';print_r( now());'</pre>';
        return view('pages.borrowBooks.manage_borrow')
        ->with('manage_borrow_books', $manage_borrow_books)->with('borrowing',$borrowing);
    }

    public function search_manage_borrow(Request $request){
        $get_value = $request->value_borrow;
        $manage_borrow_books =DB::table('tbl_borrow_books')
        ->join('tbl_users','tbl_users.user_id','=','tbl_borrow_books.user_id')
        ->select('tbl_borrow_books.*','tbl_users.*')
        ->orderBy('tbl_borrow_books.borrow_books_id','desc')->where('tbl_borrow_books.borrow_books_status','=',$get_value)->get();
        $output ='';
        if($get_value==1){
            // tìm danh sách những người đang mượn
            $output.='
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                    <thead class="table-light-borrow">
                        <tr>
                            <th>#</th>
                            <th>Tên Người Mượn</th>
                            <th>Ngày Mượn</th>
                            <th>Ngày trả</th>
                            <th>Gia Hạn(+7 ngày)</th>
                            <th>Tình Trạng</th>
                            <th style="width: 100px;">Tùy Chọn</th>
                        </tr>
                    </thead>
                
                    <tbody>';
                   
                    $i=0;
                    foreach($manage_borrow_books as $muon){
                        $i++;
                        $output.='
                        <tr>        
                        <td>
                              '.$i.'
                        </td>
                  
                        <td>
                              '.$muon->user_name.'
                        </td>

                        <td>
                              '.$muon->created_at.'
                        </td>

                        <td>
                              '.$muon->pay_day.'
                        </td>
                        <td>
                              '.$muon->extension.'
                        </td>';
                        if ($muon->borrow_books_status==0){

                                    $output.='<td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>';
                        }elseif ($muon->borrow_books_status==1){
                            $output.='<td><span class="badge bg-danger">Đang Mượn</span></td>';

                              }elseif ($muon->borrow_books_status==2){
                                     $output.='<td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>';
                              }elseif ($muon->borrow_books_status==3){
                                $output.='<td><span class="badge badge-success-lighten">Đã Trả</span></td>';
                              }elseif($muon->borrow_books_status==4){
                                        $output.='<td><span class="badge badge-info-lighten">Quá Hạn</span></td>';
                              }elseif ($muon->borrow_books_status==5){
                                        $output.='<td><span class="badge badge-danger-lighten">Mất Sách</span></td>';
                              }
                        
                   
                       
                        $output.='<td>
                              <a href="'.URL('/view-borrow-detail/'.$muon->borrow_books_id).'" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                              <a href="'.URL('/delete-borrow-book/'.$muon->borrow_books_id).'" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                        </td>
                  </tr>
                        ';
                    
                    }
                    $output.='</tbody>
                </table><style>#list_id_borrow{display:none}</style>
            ';
        }elseif($get_value==2){
            //tìm danh sách những người gia hạn
            $output.='
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
            <thead class="table-light-borrow">
                <tr>
                    <th>#</th>
                    <th>Tên Người Mượn</th>
                    <th>Ngày Mượn</th>
                    <th>Ngày trả</th>
                    <th>Gia Hạn(+7 ngày)</th>
                    <th>Tình Trạng</th>
                    <th style="width: 100px;">Tùy Chọn</th>
                </tr>
            </thead>
        
            <tbody>';
           
            $i=0;
            foreach($manage_borrow_books as $giahan){
                $i++;
                $output.='
                <tr>        
                <td>
                      '.$i.'
                </td>
          
                <td>
                      '.$giahan->user_name.'
                </td>

                <td>
                      '.$giahan->created_at.'
                </td>

                <td>
                      '.$giahan->pay_day.'
                </td>
                <td>
                      '.$giahan->extension.'
                </td>';
                if ($giahan->borrow_books_status==0){

                            $output.='<td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>';
                }elseif ($giahan->borrow_books_status==1){
                    $output.='<td><span class="badge bg-danger">Đang Mượn</span></td>';

                      }elseif ($giahan->borrow_books_status==2){
                             $output.='<td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>';
                      }elseif ($giahan->borrow_books_status==3){
                        $output.='<td><span class="badge badge-success-lighten">Đã Trả</span></td>';
                      }elseif($giahan->borrow_books_status==4){
                                $output.='<td><span class="badge badge-info-lighten">Quá Hạn</span></td>';
                      }elseif ($giahan->borrow_books_status==5){
                                $output.='<td><span class="badge badge-danger-lighten">Mất Sách</span></td>';
                      }
                
           
               
                $output.='<td>
                      <a href="'.URL('/view-borrow-detail/'.$giahan->borrow_books_id).'" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                      <a href="'.URL('/delete-borrow-book/'.$giahan->borrow_books_id).'" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                </td>
          </tr>
                ';
            
            }
            $output.='</tbody>
        </table><style>#list_id_borrow{display:none}</style>
    ';
           
        }elseif($get_value==3){
            //tìm danh sách những người trả
            $output.='
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
            <thead class="table-light-borrow">
                <tr>
                    <th>#</th>
                    <th>Tên Người Mượn</th>
                    <th>Ngày Mượn</th>
                    <th>Ngày trả</th>
                    <th>Gia Hạn(+7 ngày)</th>
                    <th>Tình Trạng</th>
                    <th style="width: 100px;">Tùy Chọn</th>
                </tr>
            </thead>
        
            <tbody>';
           
            $i=0;
            foreach($manage_borrow_books as $tra){
                $i++;
                $output.='
                <tr>        
                <td>
                      '.$i.'
                </td>
          
                <td>
                      '.$tra->user_name.'
                </td>

                <td>
                      '.$tra->created_at.'
                </td>

                <td>
                      '.$tra->pay_day.'
                </td>
                <td>
                      '.$tra->extension.'
                </td>';
                if ($tra->borrow_books_status==0){

                            $output.='<td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>';
                }elseif ($tra->borrow_books_status==1){
                    $output.='<td><span class="badge bg-danger">Đang Mượn</span></td>';

                      }elseif ($tra->borrow_books_status==2){
                             $output.='<td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>';
                      }elseif ($tra->borrow_books_status==3){
                        $output.='<td><span class="badge badge-success-lighten">Đã Trả</span></td>';
                      }elseif($tra->borrow_books_status==4){
                                $output.='<td><span class="badge badge-info-lighten">Quá Hạn</span></td>';
                      }elseif ($tra->borrow_books_status==5){
                                $output.='<td><span class="badge badge-danger-lighten">Mất Sách</span></td>';
                      }
                
           
               
                $output.='<td>
                      <a href="'.URL('/view-borrow-detail/'.$tra->borrow_books_id).'" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                      <a href="'.URL('/delete-borrow-book/'.$tra->borrow_books_id).'" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                </td>
          </tr>
                ';
            
            }
            $output.='</tbody>
        </table><style>#list_id_borrow{display:none}</style>
    ';
        }elseif($get_value==4){
            //tìm danh sách những người quá hạn
            $output.='
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
            <thead class="table-light-borrow">
                <tr>
                    <th>#</th>
                    <th>Tên Người Mượn</th>
                    <th>Ngày Mượn</th>
                    <th>Ngày trả</th>
                    <th>Gia Hạn(+7 ngày)</th>
                    <th>Tình Trạng</th>
                    <th style="width: 100px;">Tùy Chọn</th>
                </tr>
            </thead>
        
            <tbody>';
           
            $i=0;
            foreach($manage_borrow_books as $quahan){
                $i++;
                $output.='
                <tr>        
                <td>
                      '.$i.'
                </td>
          
                <td>
                      '.$quahan->user_name.'
                </td>

                <td>
                      '.$quahan->created_at.'
                </td>

                <td>
                      '.$quahan->pay_day.'
                </td>
                <td>
                      '.$quahan->extension.'
                </td>';
                if ($quahan->borrow_books_status==0){

                            $output.='<td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>';
                }elseif ($quahan->borrow_books_status==1){
                    $output.='<td><span class="badge bg-danger">Đang Mượn</span></td>';

                      }elseif ($quahan->borrow_books_status==2){
                             $output.='<td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>';
                      }elseif ($quahan->borrow_books_status==3){
                        $output.='<td><span class="badge badge-success-lighten">Đã Trả</span></td>';
                      }elseif($quahan->borrow_books_status==4){
                                $output.='<td><span class="badge badge-info-lighten">Quá Hạn</span></td>';
                      }elseif ($quahan->borrow_books_status==5){
                                $output.='<td><span class="badge badge-danger-lighten">Mất Sách</span></td>';
                      }
                
           
               
                $output.='<td>
                      <a href="'.URL('/view-borrow-detail/'.$quahan->borrow_books_id).'" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                      <a href="'.URL('/delete-borrow-book/'.$quahan->borrow_books_id).'" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                </td>
          </tr>
                ';
            
            }
            $output.='</tbody>
        </table><style>#list_id_borrow{display:none}</style>
    ';
        }elseif($get_value==5){
            //tìm danh sách những người  mất sách
            $output.='
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
            <thead class="table-light-borrow">
                <tr>
                    <th>#</th>
                    <th>Tên Người Mượn</th>
                    <th>Ngày Mượn</th>
                    <th>Ngày trả</th>
                    <th>Gia Hạn(+7 ngày)</th>
                    <th>Tình Trạng</th>
                    <th style="width: 100px;">Tùy Chọn</th>
                </tr>
            </thead>
        
            <tbody>';
           
            $i=0;
            foreach($manage_borrow_books as $mat){
                $i++;
                $output.='
                <tr>        
                <td>
                      '.$i.'
                </td>
          
                <td>
                      '.$mat->user_name.'
                </td>

                <td>
                      '.$mat->created_at.'
                </td>

                <td>
                      '.$mat->pay_day.'
                </td>
                <td>
                      '.$mat->extension.'
                </td>';
                if ($mat->borrow_books_status==0){

                            $output.='<td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>';
                }elseif ($mat->borrow_books_status==1){
                    $output.='<td><span class="badge bg-danger">Đang Mượn</span></td>';

                      }elseif ($mat->borrow_books_status==2){
                             $output.='<td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>';
                      }elseif ($mat->borrow_books_status==3){
                        $output.='<td><span class="badge badge-success-lighten">Đã Trả</span></td>';
                      }elseif($mat->borrow_books_status==4){
                                $output.='<td><span class="badge badge-info-lighten">Quá Hạn</span></td>';
                      }elseif ($mat->borrow_books_status==5){
                                $output.='<td><span class="badge badge-danger-lighten">Mất Sách</span></td>';
                      }
                
           
               
                $output.='<td>
                      <a href="'.URL('/view-borrow-detail/'.$mat->borrow_books_id).'" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                      <a href="'.URL('/delete-borrow-book/'.$mat->borrow_books_id).'" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                </td>
          </tr>
                ';
            
            }
            $output.='</tbody>
        </table><style>#list_id_borrow{display:none}</style>
    ';
        }
        if($output==" "){
            echo "chưa có dữ liệu";
        }else{
            echo   $output;

        }
    }

    public function view_borrow_detail($borrow_books_id){
            $this->AuthLogin();
            $books =BorrowBooks::where('borrow_books_id',$borrow_books_id)->get();
        foreach ($books as $key => $ord) {
            $user_id = $ord->user_id;
            $authors_id = $ord->authors_id;
            $category_id = $ord->category_id;

            
        }
        $user = User::where('user_id',$user_id)->first();
        $authors = Authors::where('authors_id',$authors_id)->first();
        $category = BookCategory::where('books_category_id',$category_id)->first();

        // $borrow_detail = BorrowBooks_Detail::with('books')->where('borrow_book_id',$borrow_books_id)->get();

        $borrow_detail = DB::table('tbl_borrow_detail')
        ->join('tbl_books','tbl_books.books_id','=','tbl_borrow_detail.book_id')
        ->join('tbl_borrow_books','tbl_borrow_books.borrow_books_id','=','tbl_borrow_detail.borrow_book_id')
        ->where('borrow_book_id',$borrow_books_id)->get();
       
        // echo '<pre>';print_r( $borrow_detail);'</pre>';
        
        return view('pages.borrowBooks.borrow_detail')->with('borrow_detail',$borrow_detail)
        ->with('books',$books)->with('user',$user)->with('authors',$authors)->with('category',$category);
    
    }
    public function delete_borrow_book(Request $request, $borrow_books_id){
        $this->AuthLogin();
        BorrowBooks::where('borrow_books_id',$borrow_books_id )->delete();
        Session::put('message','Xóa sách thành công');
        return redirect::to('manage-borrow');
    }

    public function update_borrow_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $books_borrow =BorrowBooks::find($data['order_id']);
        $books_borrow->borrow_books_status = $data['order_status'];
        $out ="";
        if($books_borrow->borrow_books_status==3){
            // update ngày trả là ngày giời hiện tại khi đang thực hiện update
            $books_borrow->pay_day = Carbon::now()->format('Y-m-d H:i:s');
        }elseif($books_borrow->borrow_books_status==2){
            // neu gia hạn người dùng sẽ được gia hạn thêm 7 ngày
            $books_borrow->extension = Carbon::now()->add(7,'day')->format('Y-m-d H:i:s');
       
        }


        $books_borrow->save();
        // lấy ra book_status và update status
        if($books_borrow->borrow_books_status == 1){
			foreach($data['book_borrow_id'] as $key =>$borrow_id){
				$books = Books::find($borrow_id);
				$books_quantity = $books->books_quantity;
                $book_borrow_qty = $books->books_borrow_qty;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
                            $pro_remain = $books_quantity - $qty;
                            $books->books_quantity = $pro_remain;
                            $books->books_borrow_qty= $book_borrow_qty + $qty;
                            $books->save();
						}
				}
                
                
                
			}
            // lay ra người mượn
            $user = User::where('user_id',$books_borrow->user_id)->first();
            $data['email'][]=$user->user_email;
            $user_array = array(
                'user_name' => $user['user_name'],
                'user_phone' => $user['user_phone'],
                'user_email' => $user['user_email'],
            );
            // lay ra san pham
            foreach($data['book_borrow_id'] as $key =>$borrow){
				$books = Books::find($borrow);
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
                            $cart_array[] = array(
                                'book_name' => $books['books_name'],
                                'books_code' => $books['books_code'],
                                'book_qty' => $qty,
                            );
						}
				}  
			}
            // lấy ra ngày mượn và ngày trả 
            $borrow_pay = array(
                'created_at'=>$books_borrow['created_at'],
                'pay_day'=>$books_borrow['pay_day'],
            );
           
            $title_mail = "No-reply";
            Mail::send('pages.mail.borrowbook_email',['cart_array'=>$cart_array,'user_array'=>$user_array,'borrow_pay'=>$borrow_pay],function($message) use($title_mail,$data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });

		}elseif($books_borrow->borrow_books_status == 3){
			foreach($data['book_borrow_id'] as $key =>$borrow_id){
               
				$books = Books::find($borrow_id);
				$books_quantity = $books->books_quantity;
                $book_borrow_qty = $books->books_borrow_qty;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
                            $pro_remain = $books_quantity + $qty;
                            $books->books_quantity = $pro_remain;
                            $books->books_borrow_qty= $book_borrow_qty - $qty;
                            $books->save();
						}
				}
			}
		}
       
    }

    // hàm trả sách
    public function give_book_back(){
        $this->AuthLogin();
        $give_book = DB::table('tbl_borrow_detail')->join('tbl_borrow_books', 'tbl_borrow_books.borrow_books_id','=','tbl_borrow_detail.borrow_book_id')
        ->where('tbl_borrow_books.borrow_books_status','3')->get();
        // echo $give_book;
        return view('pages.borrowBooks.give_book_back')->with('give_book',$give_book);
    }

    public function delete_give_book_back($borrow_id){
        $this->AuthLogin();
        BorrowBooks::where('borrow_books_id',$borrow_id)->delete();
        Session::put('message','Xóa sách thành công');
        return redirect::to('give-book-back');
    }

   
}
