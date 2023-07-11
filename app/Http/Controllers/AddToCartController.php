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
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;

class AddToCartController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/')->send();
        }
    }

    public function show_cart_quantity()
    { 
        $cart = 0;
        $cart = (Session::get('books_id'));
        // $cart++; //
        Cart::count($cart);
        $content = Cart::content();
        $output ='
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="'.URL('show-cart-book').'" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fa-solid fa-cart-shopping noti-icon"></i>
                <span class="header-cart-quantity">'.Cart::count($cart).'</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0"> ';
                if( Cart::count($cart)==0){
                    $output.='<b class="p-2 m-2 d-flex text-center justify-content-center">Giỏ hàng đang trống</b>';
                }else{
                    $output.='<div class="row">
                        <div class="col-sm-12">';
                            foreach($content as $val){
                                if($val->options->image==null){
                                    $output.='
                                    <div class="row mt-2">
                                        <div class="col-sm-2">
                                            <img src="'.URL('/public/image/nothumb.jpg').'" alt="" srcset="" width="40px" style="height:45px">
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="d-flex">'.$val->name.'</p>
                                        </div>
                                        
                                        <div class="col-sm-2">  
                                            <a onclick="return confirm("Bạn có chắc chắn muốn xóa danh mục này không?")" 
                                            href="'.URL('/delete-cart-book/'.$val->rowId).'" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </div>';
                                }else{
                                    $output.='
                                    <div class="row mt-2">
                                        <div class="col-sm-2">
                                            <img src="'.URL('/public/image/'.$val->options->image).'" alt="" srcset="" width="40px" style="height:40px">
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="d-flex">'.$val->name.'</p>
                                        </div>
                                        
                                        <div class="col-sm-2">  
                                            <a onclick="return confirm("Bạn có chắc chắn muốn xóa danh mục này không?")" 
                                            href="'.URL('/delete-cart-book/'.$val->rowId).'" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </div>';
                                }
                           
                            }
                            $output.='
                        
                            </div>
                        </div>';
                    }
                $output.='<a href="'.URL('show-cart-book').'" class="text-center d-flex justify-content-center">Xem chi tiết</a>
            </div>
        ';
        echo $output;
    }

    public function show_cart_book(){
        $this->AuthLogin();
        $authors = Authors::orderBy('authors_id', 'DESC')->get();
        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();
        $show_cart = Books::get();
        return View('pages.cart_book.show_cart_book')
        ->with('authors', $authors)
        ->with('bookCategory',$bookCategory)
        ->with('show_cart',$show_cart);
    }

    public function save_cart_book(Request $request){
        $authors = Authors::orderBy('authors_id', 'DESC')->get();
        $bookCategory = BookCategory::orderBy('books_category_id', 'DESC')->get();

        $btn_id = $request->cart_books_id;
        $quantity = $request->cart_books__qty; //get value of quantity

        $books_infor = Books::where('books_id', $btn_id)->first();

            $data ['id'] = $books_infor->books_id;
            $data['qty'] = $quantity;
            $data['name'] = $books_infor->books_name;
            $data['price'] = $books_infor->books_price;
            $data['weight'] = '123';
            $data['options']['image'] = $books_infor->books_image;



            $carts =Cart::content();
            // echo '<pre>';print_r($get_id);'</pre>';

            if(Cart::count() > 0){
                foreach ( $carts as $cart){ 
                    $get_id = $cart->id;
                }
                if($get_id == $btn_id){
                    Session::put('message','Sách đã tồn tại trong giỏ hàng');  
                }else{
                    Cart::add($data);
                }
            }else{
                Cart::add($data);
            }                                                                                                                           
           
            return Redirect::to('show-cart-book');

    }

    public function delete_cart_book($books_id){
        Cart::update($books_id,0);
        Session::put('message','Xóa thành công');
        return Redirect::to('/show-cart-book');
    }

    public function update_quantity_borrow_books(Request $request){
        $rowId_cart = $request->rowId_cart;
        $quantity_borrow = $request->update_quantity_borrow;

        Cart::update($rowId_cart,$quantity_borrow);
        return Redirect::to('/show-cart-book');
    }
}
