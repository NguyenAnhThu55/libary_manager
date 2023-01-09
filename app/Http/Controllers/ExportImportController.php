<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExcelExports;
use App\Imports\ImportBooks;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportImportController extends Controller
{
    // Xuất BOOKS
    public function export_csv(){
        return Excel::download(new ExcelExports,'books.xlsx');
    }
    // Nhập Books
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportBooks, $path);
        return back();
    }
}
