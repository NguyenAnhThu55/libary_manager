<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowBooks as BorrowBooks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Post extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:cron';

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
    public function handle()
    {

        $books_borrow = DB::table('tbl_borrow_books')
            ->join('tbl_borrow_detail', 'tbl_borrow_detail.borrow_book_id', '=', 'tbl_borrow_books.borrow_books_id')
            ->get();

        foreach ($books_borrow as $ro) {
            $id[] = $ro->borrow_books_id;
            $checkDay[] = $ro->pay_day;
            $checkDayExtentions[] = $ro->extension;
            $dt[] = Carbon::now()->format('Y-m-d H:i:s');


            //    nếu hạn trả nhỏ hơn ngày hôm nay hoặc ngày gia hạn nhỏ hơn hôm nay
            if ( $ro->pay_day <  Carbon::now() ||  $ro->extension <  Carbon::now()) {
                //update trạng thái thành quá hạn (value == 4)
                if ($ro->borrow_books_status == 1 || $ro->borrow_books_status == 2) {
                    
                    DB::table('tbl_borrow_books')
                        ->join('tbl_borrow_detail', 'tbl_borrow_detail.borrow_book_id', '=', 'tbl_borrow_books.borrow_books_id')->update($ro->borrow_books_status,'4');
                }
            }
        }
    }
}
