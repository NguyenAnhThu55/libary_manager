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
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td style="color:black">{{ $get_info_tthl->user_name }}</td>
                                        <td style="color:black">{{ $get_info_tthl->ma_sv }}</td>
                                        <td style="color:black">{{ $get_info_tthl->email_sv }}</td>
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

                                            <th>Tên sách</th>
                                            <th>Tác Giả(nếu có)</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>

                                            <td style="color:black">{{ $get_info_tthl->book_name }}</td>
                                            <td style="color:black">{{ $get_info_tthl->authors_name }}</td>
                                        </tr>
                                        <tr>

                                            <td style="color:black">{{ $get_info_tthl->book_name2 }}</td>
                                            <td style="color:black">{{ $get_info_tthl->authors_name2 }}</td>
                                        </tr>
                                        <tr>

                                            <td style="color:black">{{ $get_info_tthl->book_name3 }}</td>
                                            <td style="color:black">{{ $get_info_tthl->authors_name3 }}</td>
                                        </tr>

                                        <td colspan="2" class="mb-2">
                                           
                                                @if ($get_info_tthl->borrow_tthl_status==0)
                                                <form action="">
                                                    <b style="color:black">Tình Trạng</b>
                                                    <select name="borrow_detail_tthl_status"
                                                        class="form-select borrow_detail_tthl_status" id="">
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" selected value="0">Đang
                                                            Chờ</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" value="1">Đang
                                                            Mượn</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" value="2">Đã Trả
                                                        </option>
                                                    </select>
                                                </form>
                                                @elseif ($get_info_tthl->borrow_tthl_status==1)
                                                <form action="">
                                                    <b style="color:black">Tình Trạng</b>
                                                    <select name="borrow_detail_tthl_status"
                                                        class="form-select borrow_detail_tthl_status" id="">
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"  value="0">Đang
                                                            Chờ</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" selected value="1">Đang
                                                            Mượn</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" value="2">Đã Trả
                                                        </option>
                                                    </select>
                                                </form>
                                                @elseif ($get_info_tthl->borrow_tthl_status==2)
                                                <form action="">
                                                    <b style="color:black">Tình Trạng</b>
                                                    <select name="borrow_detail_tthl_status"
                                                        class="form-select borrow_detail_tthl_status" id="">
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"  value="0">Đang
                                                            Chờ</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"  value="1">Đang
                                                            Mượn</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}" selected value="2">Đã Trả
                                                        </option>
                                                    </select>
                                                </form>
                                                @else
                                                <form action="">
                                                    <b style="color:black">Tình Trạng</b>
                                                    <select name="borrow_detail_tthl_status"
                                                        class="form-select borrow_detail_tthl_status" id="">
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"  value="0">Đang
                                                            Chờ</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"  value="1">Đang
                                                            Mượn</option>
                                                        <option id="{{ $get_info_tthl->borrow_tthl_id }}"value="2">Đã Trả
                                                        </option>
                                                    </select>
                                                </form>
                                                
                                                @endif
                                          
                                            
                                        </td>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        @endsection
