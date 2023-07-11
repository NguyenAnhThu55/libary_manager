@extends('layout')
@section('content')
                        
      <div class="container">
       
          <!-- start page title -->
          <div class="row">
            <div class="col-8">
                <div class="page-title-box">
                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thư viện</a></li>
                            <li class="breadcrumb-item active">Quản Lý Đơn Vị</li>
                        </ol>
                    </div> --}}
                    <h2 class="page-title" >Danh Sách Mượn</h2>
                </div>
            </div>
            <?php
            $message = Session::get('message');
            if($message){
                echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                session::put('message', null);
            }
            ?>
        </div>     
        <!-- end page title --> 
        
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                @php
                                $content = Cart::content();
                                $count = Cart::count();
                                
                                @endphp

                                <a href="http://localhost/library-manager/thong-ke-sach">Chọn Sách</a>
                                <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap" id="products-datatable">
                                    <thead class="table-light">
                                        <tr>                    
                                            <th>#</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sách</th>
                                            <th style="width: 155px;">Số lượng mượn</th>
                                            <th >Tùy Chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if ($count == 0)
                                            <tr>
                                                <td></td>
                                                <td class="d-flex text-center justify-content-center"><h4>Chưa có sách chờ mượn</h4></td>
                                            </tr>
                                       @else
                                       @php
                                       $i=0;
                                       
                                       @endphp
                                       @foreach($content as $key=> $cart)
                                       
                                       <tr>
                                           @if ($cart == "")
                                               <td>Chưa có Sách Trong Giỏ Hàng</td>
                                               @else
                                                   @php
                                                   $i++;
                                                   @endphp
                                                   <td>
                                                       {{$i}}
                                                   </td>
                                                   
                                                   <td>
                                                        @if ($cart->options->image==null)
                                                        <img src="{{URL::to('/public/image/nothumb.jpg')}}" altwidth="80" height="80">
                                                        @else
                                                        <img src="{{URL::to('/public/image/'.$cart->options->image)}}" altwidth="80" height="80">
                                                        @endif
                                                   </td>
                                                   <td>
                                                       {{ $cart->name}}
                                                   </td>
                                                   <td style="text-align: center">
                                                        <style>
                                                            .cart_quantity_input{
                                                                border: none;
                                                                width: 35px;
                                                            }
                                                            .update_qty_btn{
                                                                border: none;
                                                                border-radius: 4px;
                                                                width: 30px; 
                                                            }
                                                        </style>
                                                        <form action="{{URL::to('/update-quantity-borrow-books')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$cart->rowId}}" name="rowId_cart" id="rowId_cart">
                                                            <input type="number" min="1" max="10" id="update_quantity_borrow" name="update_quantity_borrow" class="cart_quantity_input" value="{{$cart->qty}}"> 
                                                            <input type="submit" value="✔" name="update_qty_btn" class="update_qty_btn">
                                                        </form>
                                                   </td>
                                                   <td>
                                                       <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{URL::to('/delete-cart-book/'.$cart->rowId)}}" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
                                                   </td>
                                                                           
                                               @endif
                                               </tr>
                                           @endforeach     
                                           
                                       @endif                     
                                        
                                    </tbody>
                                </table>
                            </div>  
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
                
                   
                    <div class="col-sm-5">
                        <div class="page-title-box p-4">
                            <h3>Nhập Thông Tin Mượn Sách</h3>
                            <div class="page-title">
                                <form  action="{{URL::to('/save-borrowing')}}" method="POST">
                                    @csrf
                                    <h6 value="">Chọn Hình Thức Mượn</h6>
                                    <div class="input-group mb-2 mt-2">
                                        <select name="choose-loan" class="form-select borrow_detail_status" id="choose-loan">
                                            <option value="1">Đọc Ngay</option>
                                            <option value="2">Mượn về</option>
                                        </select>
                                    </div>

                                    <h6>Nhập mã số CB/SV</h6>
                                    <div class="input-group">
                                        <input id="check_user_code" required name="check_user_code" type="text" class="form-control form-control-light" >
                                        
                                    </div>
                                   
                                    <div class="mt-2" id="show_name_user">     
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
                    
               
            </div>
            <!-- end row -->
            
        
      </div>
@endsection