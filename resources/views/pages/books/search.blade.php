@extends('layout')
@section('content')
     <!-- Start Content-->
     <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-11">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Thư viện</a></li>
                            <li class="breadcrumb-item ">Quản Lý Sách</li>
                            <li class="breadcrumb-item ">Thống Kê</li>
                            <li class="breadcrumb-item mr-4 active">Tìm Kiếm</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Tìm Kiếm Sách</h2>
                </div>
            </div>
           
        </div>     
          <!-- end page title --> 

          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <!-- Button trigger modal -->
                            <div class="col-sm-12">
                                <div class="text-sm-end">
                                   
                                    <button type="button" class="btn btn-danger mb-2  float-left" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        Thêm Sách
                                    </button>
                                    

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Thêm Sách</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                    <form action="{{url('/save-book')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="d-flex">Nhập Tên sách</label>
                                                            <input type="text" class="form-control" name="books_name"  placeholder="vd: giáo trình ngoại ngữ">
                                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="d-flex">Đặt Đường Dẫn</label>
                                                            <input type="text" class="form-control" name="books_slug"  placeholder="vd: giao-trinh-dep">
                                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label class="d-flex">Thể Loại Sách</label>
                                                            <select name="category_of_book" class="form-select" >
                                                                <option value="">---Chọn Loại Sách---</option>
                                                                @foreach ($bookCategory as $key => $category_books)
                                                                    <option value="{{$category_books->books_category_id}}">{{$category_books->books_category_name}}</option>
                                                                
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="d-flex">Tác Giả Sách</label>
                                                            <select name="author_of_book" class="form-select" >
                                                                <option value="">--Chọn Tác Giả---</option>
                                                                @foreach ($authors as $key => $authors_of_book)
                                                                <option value="{{$authors_of_book->authors_id}}">{{$authors_of_book->authors_name}}</option>
                                                            
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label class="d-flex">Giá Sách</label>
                                                            <input type="number" class="form-control" name="books_price"  placeholder="10 000">
                                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="d-flex">Số lượng kho</label>
                                                            <input type="number" class="form-control" name="books_quantity"  placeholder="10">
                                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="d-flex">Hình Ảnh</label>
                                                            <input type="file" class="form-control" name="books_image">
                                                            {{-- <img src="{{('public/image/'.$pro->product_image)}}" altwidth="100" height="100"> --}}
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="d-flex">Tình Trạng</label>
                                                            <select name="books_status" class="form-select" >
                                                                <option value="1">Hiện</option>
                                                                <option value="2">Ẩn</option>
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary" name="add_book">Thêm</button>
                                                    
                                                    </form>
                                                </div>
                                               
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table id="" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                                <thead class="table-light-borrow">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"  id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                      
                                        <th>Tên Sách</th>
                                        <th>Hình Ảnh</th>
                                        <th>Mã Sách</th>
                                        <th>Tên Tác Giả</th>
                                        <th>Số lượng kho</th>
                                      
                                        <th style="width: 155px;">Tùy Chọn</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    
                                    @foreach ($search_book as $key => $list_book)
                                        
                                        <form action="{{URL::to('/save-cart-book')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cart_books_id" class="cart_books_id_{{$list_book->books_id}}" value="{{$list_book->books_id}}">
                                            {{-- <input type="hidden" name="borrows_books_id" class="borrows_books_id" value="{{$borrow_books_detail->book_id}}"> --}}
                                            {{-- <input type="hidden" name="cart_books_image" class="cart_books_image_{{$list_book->books_id}}" value="{{$list_book->books_image}}"> --}}
                                            <input type="hidden" name="cart_books__qty" class="cart_books__qty_{{$list_book->books_id}}" value="1">
                                            
                                            @if($list_book->books_quantity>0)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <button class="btn btn-success add-to-cart" name="{{$list_book->books_id}}"
                                                                    style="font-size: 10px;
                                                                    margin-left: -25px;
                                                                    padding: 4px;"
                                                                    type="submit">
                                                            <i class="fa-solid fa-plus m-1"></i>
                                                            </button>
                                                        </div>
                                                       
                                                    </td>

                                                   
                                                
                                                    <td>
                                                       
                                                        {{$list_book->books_name}}
                                                    </td>

                                                    @if ($list_book->books_image == null)
                                                    <td>
                                                        <img src="{{('public/image/nothumb.jpg')}}" altwidth="40" height="40">
                                                    </td>
                                                    @else
                                                    <td>
                                                        <img src="{{('public/image/'.$list_book->books_image)}}" altwidth="40" height="40">
                                                    </td>
                                                    @endif


                                                    <td>
                                                       
                                                        {{$list_book->books_code}}
                                                    </td>
        
                                                    <td>
                                                        {{$list_book->authors_name}}
                                                    </td>
                                                    {{-- số lượng kho còn --}}
                                                    <td id="borrow_qty">
                                                       @php
                                                           $total_book = $list_book->books_quantity  + $list_book->books_borrow_qty;
                                                       @endphp
                                                        {{$list_book->books_quantity.'/'.$total_book}}
                                                    </td>
                
                                                    <td>

                                                        <a href="{{URL::to('/detail-book/'.$list_book->books_slug)}}" class="action-icon"><i class="far fa-eye"></i></a>
                                                        <a href="{{URL::to('/edit-book/'.$list_book->books_slug)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-book/'.$list_book->books_slug)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                @else
                                                <tr class="bg-danger text-dark">
                                                    <td>
                                                        <div onclick="return confirm('Hiện Tại Danh Mục Này Đã Hết');" class="form-check">
                                                            <div class="btn btn-secondary"
                                                                    style="font-size: 10px;
                                                                    margin-left: -25px;
                                                                    padding: 4px;"
                                                                    type="">
                                                                <i class="fa-solid fa-xmark m-1"></i>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{$i}}
                                                    </td>
                                                
                                                    <td>
                                                       
                                                        {{$list_book->books_name}}
                                                    </td>
        
                                                    <td>
                                                        {{$list_book->authors_name}}
                                                    </td>
                                                    {{-- số lượng kho còn --}}
                                                    <td id="borrow_qty">
                                                       @php
                                                           $total_book = $list_book->books_quantity  + $list_book->books_borrow_qty;
                                                       @endphp
                                                        {{$list_book->books_quantity.'/'.$total_book}}
                                                    </td>
        
                                                    <td>
                                                        {{$list_book->books_category_name}}
                                                    </td>
        
                                                    <td>
                                                        <img src="{{('public/image/'.$list_book->books_image)}}" altwidth="40" height="40">
                                                    </td>
        
                                                   
                                                        @if ($list_book->books_status==1)
                                                        <td>
                                                            {{"Hiển Thị"}}
                                                        </td>
                                                        @else
                                                        <td>
                                                            {{"Ẩn"}}
                                                        </td>
                                                            
                                                        @endif
                                                 
                
                                                    <td>
                                                    
                                                        <a href="{{URL::to('/detail-book/'.$list_book->books_slug)}}" class="action-icon"><i class="far fa-eye"></i></a>
                                                        <a href="{{URL::to('/edit-book/'.$list_book->books_slug)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-book/'.$list_book->books_slug)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                @endif
                                            
                                                
                                        </form>
                                    @endforeach

                                </tbody>
                            </table>
                            <a href="http://localhost/library-manager/thong-ke-sach">Quản lý Sách</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection