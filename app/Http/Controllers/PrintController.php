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
use App\Models\BorrowBooks;
use App\Models\User;
use App\Models\BorrowBooks_Detail;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;

class PrintController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }
    
    public function print_barcode(){
        $this->AuthLogin();
        $print_barcode = DB::table('tbl_books')->select('barcode','books_code')->get();
        $output = '';
        foreach($print_barcode as $print_code){
            $output.= '
                        <div>
                            <div style="">'
                                .$print_code->barcode. 
                                '<span style="margin-bottom: 20px; display:block;">'.$print_code->books_code.'</span>
                            </div>
                        </div>
                       ';
                       
        }
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();
    }
    public function print_receipt($borrow_books_id){
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($this->print_receipt_convert($borrow_books_id));
        return $pdf->stream();
    }
    public function print_receipt_convert($borrow_books_id){

        $books =BorrowBooks::where('borrow_books_id',$borrow_books_id)->get();
        foreach ($books as $key => $ord) {
            $user_id = $ord->user_id;
        }
        $user = User::where('user_id',$user_id)->first();
        $borrow_detail = BorrowBooks_Detail::where('borrow_book_id',$borrow_books_id)
        ->join('tbl_borrow_books','tbl_borrow_books.borrow_books_id','=','tbl_borrow_detail.borrow_book_id')
        ->get();
        $output ='';
        $output.='
       
        <style>
            body{
                font-family:DejaVu Sans;
            }
            .header{
                text-align:center;
            }
            .body{
                margin-left:20px;
            }
            .table{
                margin-top:20px;
            }
            .footer{
                margin-top:20px;
            }
            .left{

                display:flex;
                float:left;
               margin-right:50px;
            }
            .right{
                display:flex;
                float:right;
                margin-right:50px;
            }
        </style>
           <div class="header">
                <h3 >Thư Viện Khoa Phát Triển Nông Thôn</h3>
                <h4>Library manager</h4>

                <h3 style="color: red">BIÊN LAI THU TIỀN PHẠT MẤT SÁCH</H3>
           </div>

           <div class="body">
                <div class="info">
                    Họ Và Tên : <strong>'.$user->user_name.'</strong>
                  
                </div>
                <div class="info">
               
                    MSSV : <strong>'.$user->user_code.'</strong>
               
                </div>
                <div class="info">
                
                    Email : <strong>'.$user->user_email.'</strong>
                </div>

                <div class="info">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên Sách</th>
                                <th>Giá Sách</th>
                                <th>Ngày mượn</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($borrow_detail as $row){
                        $output.='
                            <tr>
                                <td>'.$row->book_name.'</td>
                                <td>'.number_format($row->book_price)."đ".'</td>
                                <td>'.$row->created_at.'</td>
                            </tr>';
                        }
                        $output.='
                        </tbody>
                    </table>
                
                </div>

                <div class="footer">
                    <div class="row">
                        <div class="col-6 left">
                            <b>Người bị phạt</b>
                        </div>
                        <div class="col-6 right">
                            <b>Người lập phiếu</b>
                        </div>
                    </div>

                </div>
           
           </div> 
        ';
        return $output;
    }
   
}
