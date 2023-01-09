<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\BorrowBooksController;
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\majorsController;
use App\Http\Controllers\BorrowInTTHLController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// LOGIN
Route::post('/admin-login','HomeController@admin_login');
Route::get('/admin-logout','HomeController@admin_logout');

// Home routes
Route::get('/','HomeController@login');
Route::get('/trang-chu','HomeController@index');
// SearCH
Route::post('/search','HomeController@search');

// DOCUMENT MANAGEMENT
Route::get('/them-tai-lieu','DocumentController@add_book');

// SEND MAIL
Route::get('/borrow-email','SendMailController@borrow_email');


//  Books management
Route::get('/them-sach','BookController@add_book');
Route::get('/thong-ke-sach','BookController@list_book');
Route::get('/detail-book/{books_slug}','BookController@detail_book');

Route::get('/edit-book/{books_slug}','bookController@edit_book');
Route::get('/delete-book/{books_slug}','bookController@delete_book');

Route::post('/save-book','bookController@save_book');
Route::post('/update-book/{books_slug}','bookController@update_book');

// phập Xuất files excel
Route::post('/export-csv','ExportImportController@export_csv');
Route::post('/import-csv','ExportImportController@import_csv');


// ALL BARCODE 
Route::get('/all-barcodes','BookController@all_barcode');

// BOOK CARTEGORY
Route::get('/loai-sach','BookCategoryController@list_BookCategory');
Route::get('/edit-book-category/{bookCategory_id}','BookCategoryController@edit_BookCategory');
Route::get('/delete-book-category/{bookCategory_id}','BookCategoryController@delete_BookCategory');

Route::post('/save-book-category','BookCategoryController@save_BookCategory');
Route::post('/update-book-category/{bookCategory_id}','BookCategoryController@update_BookCategory');

// majors 
Route::get('/khoa-truc-thuoc','majorsController@list_majors');
Route::get('/edit-majors/{majors_id}','majorsController@edit_majors');
Route::get('/delete-majors/{majors_id}','majorsController@delete_majors');

Route::post('/save-majors','majorsController@save_majors');
Route::post('/update-majors/{majors_id}','majorsController@update_majors');

// AUTHORS
Route::get('/tac-gia','AuthorController@list_authors');
Route::get('/edit-authors/{authors_id}','authorController@edit_authors');
Route::get('/delete-authors/{authors_id}','authorController@delete_authors');

Route::post('/save-authors','authorController@save_authors');

Route::post('/update-authors/{authors_id}','authorController@update_authors');

// /add-to-cart

Route::post('/add-to-cart','AddToCartController@add_to_cart');
Route::post('/save-cart-book','AddToCartController@save_cart_book');
Route::get('/show-cart-book','AddToCartController@show_cart_book');

Route::get('/delete-cart-book/{books_id}','AddToCartController@delete_cart_book');

// CHECK User
Route::get('/check-user','CheckUserController@check_user');

Route::get('/register-user','CheckUserController@register_user');
Route::get('/list-users','CheckUserController@list_users');

Route::post('/add-user','CheckUserController@add_user');
Route::get('/delete-user/{user_id}','CheckUserController@delete_user');
Route::get('/edit-user/{user_id}','CheckUserController@edit_user');
Route::post('/update-user/{user_id}','CheckUserController@update_user');
// Borrowing list

Route::post('/save-borrowing','BorrowBooksController@save_borrowing');
Route::get('/manage-borrow','BorrowBooksController@manage_borrow');
Route::get('/view-borrow-detail/{borrow_books_id}','BorrowBooksController@view_borrow_detail');
Route::post('/update-book-borrow-status','BorrowBooksController@update_borrow_status');

Route::get('/delete-borrow-book/{borrow_books_id}','BorrowBooksController@delete_borrow_book');

// count cart book
Route::get('/show-cart-quantity','AddToCartController@show_cart_quantity');

// GIVE BOOK BACK
Route::get('/give-book-back','BorrowBooksController@give_book_back');
Route::get('/delete-give-book-back/{borrow_id}','BorrowBooksController@delete_give_book_back');

// Print barcode
Route::get('/print-barcode','PrintController@print_barcode');

// mượn ở TTHL
Route::get('/list-borrow-tthl','BorrowInTTHLController@list_borrow_tthl');

Route::post('/save-borrowing-tthl','BorrowInTTHLController@save_borrowing_tthl');

Route::get('/edit-borrow-tthl/{borrow_tthl_id}','BorrowInTTHLController@edit_borrow_tthl');

Route::post('/update-borrow-tthl/{borrow_tthl_id}','BorrowInTTHLController@update_borrow_tthl');
Route::get('/delete-borrow-tthl/{borrow_tthl_id}','BorrowInTTHLController@delete_borrow_tthl');

Route::post('/update-borrow-tthl-status/{borrow_tthl_id}','BorrowInTTHLController@update_borrow_tthl_status');