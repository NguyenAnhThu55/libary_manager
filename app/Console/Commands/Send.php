<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowBooks as BorrowBooks;
use App\Models\User as User;
use Carbon\Carbon as CarbonCarbon;
use App\Console\Commands\DataTime;

class Send extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Request $request)

    {
        //lấy ra tình trạng và ngày trả 
        
        $books_borrow = DB::table('tbl_borrow_books')
        ->join('tbl_borrow_detail','tbl_borrow_detail.borrow_book_id','=','tbl_borrow_books.borrow_books_id')
        ->get();
         foreach($books_borrow as $ro){
            $checkDay[]=$ro->pay_day;
            $checkDayExtentions[]=$ro->extension;
            $userName[]=$ro->user_name;
         }
        //nếu trạng thái đang ở quá hạn thì sẽ gửi mail

        if($ro->borrow_books_status==4){
            $email=$ro->user_email;
            
            $title_mail = "No-reply";
            Mail::send('pages.mail.notifyEmail',['userName'=>$userName],function($message) use($title_mail,$email){
                $message->to($email)->subject($title_mail);
                $message->from($email,$title_mail);
            });
        }
        // $dt[] = Carbon::now()->format('Y-m-d H:i:s');
       
      
       

    }
}
