@extends('layout')
@section('content')
                        
      <div class="container">
       
          <!-- start page title -->
          <div class="row">
            <div class="col-8">
                <div class="page-title-box">
                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item active">Quản Lý Đơn Vị</li>
                        </ol>
                    </div> --}}
                    <h2 class="page-title" >Danh Sách Mượn</h2>
                </div>
            </div>
           
            <div class="col-3 mt-3 app-search dropdown d-none d-lg-block">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                        <span class="mdi mdi-magnify search-icon"></span>
                        <button class="input-group-text btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </form>  
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
                                <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap" id="products-datatable">
                                    <thead class="table-light">
                                        <tr>                    
                                            <th>#</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sách</th>
                                            <th>Số lượng mượn</th>
                                            <th style="width: 155px;">Tùy Chọn</th>
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
                                                       <img src="{{URL::to('/public/image/'.$cart->options->image)}}" altwidth="80" height="80">
                                                   </td>
                                                   <td>
                                                       {{ $cart->name}}
                                                   </td>
                                                   <td>
                                                       {{$cart->qty}}
                                                   </td>
                                                   <td>
                                                       <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{URL::to('/delete-cart-book/'.$cart->rowId)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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