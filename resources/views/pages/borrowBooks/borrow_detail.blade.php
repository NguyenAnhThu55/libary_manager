@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                       <h3 class="mt-4 mb-1"> Thông tin chi tiết <b class="text-dark">người mượn sách</b></h3>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover b-t b-light">
                            <thead class="table-primary">
                                <tr>
                                    <th>Tên người mượn</th>
                                    <th>Mã số CB/SV</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <tr>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->user_code}}</td>
                                        <td>{{$user->user_phone}}</td>
                                        <td>{{$user->user_email}}</td>
                                    </tr>    
                              
                                   
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-sm-10">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                       <h3 class="mt-4 mb-1"> Thông tin chi tiết <b class="text-dark">sách mượn</b></h3>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover b-t b-light">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên sách</th>
                                    <th>Tác Giả</th>
                                    <th>Thể Loại</th>
                                    <th>giá sách</th>
                                    <th>Số lượng Kho</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            @php
                                $i=0;
                            @endphp
                            <tbody>
                                    @foreach ($borrow_detail as $key=>$val_detail)
                                    @php
                                        $i++;
                                    @endphp
                                        <tr class="color_qty_{{$val_detail->book_id}}">
                                            <td>{{$i}}</td>
                                            <td>{{$val_detail->book_name}}</td>
                                            <td>{{$val_detail->authors_name}}</td>
                                            <td>{{$val_detail->category_name}}</td>
                                            <td>{{$val_detail->book_price}}</td>
                                            <td>{{$val_detail->books_quantity}}</td>
                                            <td>
                                                <input type="hidden" value="{{$val_detail->books_quantity}}" name="book_qty_storage" class="book_qty_storage_{{$val_detail->book_id}}">
                                                <input type="hidden" value="{{$val_detail->book_borrow_qty}}" name="book_sales_qty" class="order_qty_{{$val_detail->book_id}}">
                                                <input type="hidden" value="{{$val_detail->book_id}}" name="book_borrow_id">
                                                {{$val_detail->book_borrow_qty}}
                                            </td>
                                        </tr>    
                                        
                                    @endforeach

                                    <tr>
                                        <td colspan="2">
                                            @foreach ($books as $status)
                                                @if ($status->borrow_books_status==1)
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" value="1" selected>Đang Mượn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="2">Gia Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="3">Đã Trả</option>
                                                        <option id="{{$status->borrow_books_id}}" value="4">Quá Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="5">Mất Sách</option>
                                                    </select>
                                                </form>
                                                @elseif ($status->borrow_books_status==2)
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" value="2" selected >Gia Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="3">Đã Trả</option>
                                                        <option id="{{$status->borrow_books_id}}" value="4">Quá Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="5">Mất Sách</option>
                                                    </select>
                                                </form>
                                                @elseif ($status->borrow_books_status==3)
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" value="3"selected>Đã Trả</option>
                                                    </select>
                                                </form>
                                                @elseif ($status->borrow_books_status==4)
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" value="2">Gia Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="3">Đã Trả</option>
                                                        <option id="{{$status->borrow_books_id}}" selected value="4">Quá Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="5">Mất Sách</option>
                                                    </select>
                                                </form>
                                                @elseif ($status->borrow_books_status==5)
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" selected value="5">Mất Sách</option>
                                                    </select>
                                                </form>
                                                @else
                                                <form action="">
                                                    @csrf
                                                    <select name="borrow_detail_status" class="form-select borrow_detail_status" id="">
                                                        <option id="{{$status->borrow_books_id}}" value="">--chọn--</option>
                                                        <option id="{{$status->borrow_books_id}}" value="1">Đang Mượn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="2">Gia Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="3">Đã Trả</option>
                                                        <option id="{{$status->borrow_books_id}}" value="4">Quá Hạn</option>
                                                        <option id="{{$status->borrow_books_id}}" value="5">Mất Sách</option>
                                                    </select>
                                                </form>
                                                @endif
                                            @endforeach
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                    </tr>
                              
                            </tbody>
                        </table>
                        {{-- trường hợp nếu làm mát sách sẽ phạt tiền --}}
                        @if ($status->borrow_books_status==5)
                            <div class="container-lost-book" id="show_lost_book">
                                <div class="lost-book">
                                    <h2>Thông Tin Mất Sách</h2>
                                    <p class="text-danger">Vì lý do bạn làm mất sách nên chúc tôi cần phải phạt tiền bạn!</p>
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên Sách</th>
                                                <th>Giá</th>
                                                <th>Ngày mượn</th>
                                            </tr>
                                        </thead>
                                    
                                    
                                        @php
                                            $i=0;
                                        @endphp
                                        <tbody>
                                            @foreach ($borrow_detail as $key=>$lost_detail)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$lost_detail->book_name}}</td>
                                                <td><b>{{number_format($lost_detail->books_price).'đ'}}</b></td>
                                                <td>{{$lost_detail->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <a href="{{URL::to('/print-receipt/'.$lost_detail->borrow_books_id)}}"><button class="btn btn-primary ml-3 mb-2 mt-3">Thu Tiền</button></a>
                                </div>
                            </div>
                            
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
        <div><a href="http://localhost/library-manager/manage-borrow">trở lại</a></div>

    </div>

@endsection