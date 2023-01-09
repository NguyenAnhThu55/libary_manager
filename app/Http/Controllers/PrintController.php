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

   
}
