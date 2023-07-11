@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-2"></div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-8">
                <h2 class="">Cập Nhật Thông tin mượn</h2>
                @foreach ($edit_borrow_tthl as $key => $val)
                
                    <form action="{{url('/update-borrow-tthl/'.$val->borrow_tthl_id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex">Tên Người Mượn</label>
                            <input type="text" class="form-control" name="user_name" value="{{$val->user_name}}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex">MSSV</label>
                            <input type="text" class="form-control" name="ma_sv" value="{{$val->ma_sv}}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Email SV</label>
                            <input type="email" class="form-control" name="email_sv" value="{{$val->email_sv}}">
                            
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Tên sách (1)</label>
                            <input type="text" class="form-control" name="book_name" value="{{$val->book_name}}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Tên Tác Giả (nếu có)</label>
                            <input type="text" class="form-control" name="authors_name"value="{{$val->authors_name}}">
                        </div>

                        <div class="form-group">
                            <label class="d-flex">Tên sách (2)</label>
                            <input type="text" class="form-control" name="book_name2" value="{{$val->book_name2}}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Tên Tác Giả (nếu có)</label>
                            <input type="text" class="form-control" name="authors_name2"value="{{$val->authors_name2}}">
                        </div>

                        <div class="form-group">
                            <label class="d-flex">Tên sách (3)</label>
                            <input type="text" class="form-control" name="book_name3" value="{{$val->book_name3}}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Tên Tác Giả (nếu có)</label>
                            <input type="text" class="form-control" name="authors_name3"value="{{$val->authors_name3}}">
                        </div>

                        <div class="form-group">
                            <label >Tình Trạng</label>
                            @if ($val->borrow_tthl_status ==0)
                            <td>
                                <select name="borrow_tthl_status" id="" >
                                    <option value="0"selected><span class="" style="font-size: 13px">Đang chờ</span></option>
                                    <option value="1"><span class="" style="font-size: 13px">Đã có</span></option>
                                    <option value="2"><span class="badge bg-danger">Đang Mượn</span></option>
                                    <option value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                </select>
                            </td>
                            @elseif ($val->borrow_tthl_status==1)
                                <td>
                                    <select name="borrow_tthl_status" id="" >
                                        <option value="0" ><span >Đang chờ</span></option>
                                        <option value="1"selected><span >Đã có</span></option>
                                        <option value="2"><span class="badge bg-danger">Đang Mượn</span></option>
                                        <option value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                    </select>
                                </td>
                            @elseif ($val->borrow_tthl_status==2)
                                <td>
                                    <select name="borrow_tthl_status" id="">
                                        <option value="0" ><span >Đang chờ</span></option>
                                        <option value="1"><span >Đã có</span></option>
                                        <option value="2"selected><span class="badge bg-danger">Đang Mượn</span></option>
                                        <option value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                    </select>
                                </td>
                            @elseif ($val->borrow_tthl_status==3)
                                <td>
                                    <select name="borrow_tthl_status" id="" >
                                        <option value="0" ><span >Đang chờ</span></option>
                                        <option value="1"><span >Đã có</span></option>
                                        <option value="2" ><span class="badge bg-danger">Đang Mượn</span></option>
                                        <option value="3"selected><span class="badge badge-success-lighten">Đã Trả</span></option>
                                    </select>
                                </td>
                                @elseif ($val->borrow_tthl_status==4)
                                <td>
                                    <select name="borrow_tthl_status" id="" >
                                        <option value="0" ><span >Đang chờ</span></option>
                                        <option value="1"><span >Đã có</span></option>
                                        <option value="2" ><span class="badge bg-danger">Đang Mượn</span></option>
                                        <option value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                        <option value="4"selected><span class="badge badge-success-lighten">Đã Gia Hạn</span></option>
                                    </select>
                                </td>
                                
                            @endif
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="updated_book">Thêm</button>
                    
                    </form>
                @endforeach
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-2 mb-5"></div>
        </div>
    </div>
@endsection