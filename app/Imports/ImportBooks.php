<?php

namespace App\Imports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportBooks implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Books([
            'books_name'=>$row[0],
            'authors_id'=>$row[1],
            'books_category_id'=>$row[2],
            'books_slug '=>$row[3],
            'books_price'=>$row[4],
            'books_quantity'=>$row[5],
            'books_borrow_qty'=>0,
            'books_image'=>'1',
            'books_status'=>0,
        ]);
    }
}
