@extends('layout')
@section('content')
                        
      <div class="container">
        <div class="container-fluid">
                        
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item mr-4 active">DS mượn TTHL</li>
                            </ol>
                        </div>
                        <h2 class="page-title" >Danh Sách Mượn Từ Trung Tâm Học Liệu</h2>
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
            <div class="row">
               
                <div class="col-sm-12">
                    <div class="text-sm-end">
                                   
                        <button type="button" class="btn btn-danger mb-2  float-left" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-plus-circle me-2"></i>
                            Thêm Sách mượn
                        </button>
                        

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Thêm Sách mượn ở TTHL</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{url('/save-borrowing-tthl')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Tên SV: </label>
                                                <input type="text" required class="form-control" name="sv_tthl_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex">Nhập MSSV: </label>
                                                <input type="text" required class="form-control" name="mssv_tthl_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Email: </label>
                                                <input type="email" required class="form-control" name="email_sv">
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Tên Sách cần mượn ở Trung tâm học liệu: </label>
                                                <input type="text" required class="form-control" name="book_tthl_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Tên Tác Giả (nếu có): </label>
                                                <input type="text" class="form-control" name="authors_tthl_name">
                                            </div>

                                            <div class="form-group">
                                                <label >Tình Trạng</label>
                                                <select required name="tthl_status" id="">
                                                    <option value="0">Đang chờ</option>
                                                    <option value="1">Đã có</option>
                                                    <option value="2">Đã mượn</option>
                                                    <option value="2">Đã Gia Hạn</option>
                                                    <option value="3">Đã Trả</option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary myBtn" name="add_borrow_tthl">Thêm</button>
                                        
                                        </form>
                                    </div>
                                   
                            </div>
                            </div>
                        </div> 
                    </div>
                   
                </div><!-- end col-->
                <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                            <thead class="table-light-borrow">
                                <tr>
                                    <th>#</th>
                                    <th>Tên Người Mượn</th>
                                    <th>MSSV</th>
                                    <th>Tên Sách</th>
                                    <th>Tên Tác Giả</th>
                                    <th>Ngày đk Mượn</th>
                                    <th>Ngày Mượn</th>
                                    <th>Ngày Gia Hạn</th>
                                    <th>Ngày Trả</th>
                                    <th>Tình Trạng</th>
                                    <th style="width: 100px;">Tùy Chọn</th>
                                </tr>
                            </thead>
                            @php
                                    $i=0;
                            @endphp
                            <tbody>
    
                                    @foreach ( $list_user_borrow_tthl as $key => $list_borrow) 
                                         @php
                                        $i++;
                                        @endphp
                                        <tr>      
                                                <td>{{$i}}</td>  
                                                <td>
                                                    {{$list_borrow->user_name}}
                                                </td>
                                        
                                                <td>
                                                    {{$list_borrow->ma_sv}}
                                                </td>
    
                                                <td>
                                                    {{$list_borrow->book_name}}
                                                </td>
    
                                                <td>
                                                    {{$list_borrow->authors_name}}
                                                </td>

                                                <td>
                                                    {{$list_borrow->borrow_day}}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
    
                                                
                                                @if ($list_borrow->borrow_tthl_status==0)
                                               
                                                   
                                                    <td>
                                                        <form action="{{URL::to('/update-borrow-tthl-status/'.$list_borrow->borrow_tthl_id)}}" method="POST" >
                                                            @csrf
                                                        <select name="borrow_tthl_status" id="borrow_tthl_status" >
                                                            <option id="{{$list_borrow->borrow_tthl_id}}" value="0"selected><span class="" style="font-size: 13px">Đang chờ</span></option>
                                                            <option id="{{$list_borrow->borrow_tthl_id}}" value="1"><span class="" style="font-size: 13px">Đã có</span></option>
                                                            <option id="{{$list_borrow->borrow_tthl_id}}" value="2"><span class="badge bg-danger">Đang Mượn</span></option>
                                                            <option id="{{$list_borrow->borrow_tthl_id}}" value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                                            <option id="{{$list_borrow->borrow_tthl_id}}" value="4"><span>Đã Gia Hạn</span></option>
                                                        </select>
                                                        <button type="submit" class="btn btn-light" name="updated_book">Cập nhật</button>
                                                    </form>
                                                    </td>
                                                    @elseif ($list_borrow->borrow_tthl_status==1)
                                                        <td>
                                                            <form action="{{URL::to('/update-borrow-tthl-status/'.$list_borrow->borrow_tthl_id)}}" method="POST" >
                                                                @csrf
                                                            <select name="borrow_tthl_status" id="borrow_tthl_status" class="badge badge-info"style="font-size: 13px">
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="1"selected><span class="" style="font-size: 13px">Đã có</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="2"><span class="badge bg-danger">Đang Mượn</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="4"><span>Đã Gia Hạn</span></option>
                                                            </select>
                                                            <button type="submit" class="btn btn-light" name="updated_book">Cập nhật</button>
                                                        </form>
                                                        </td>
                                                    @elseif ($list_borrow->borrow_tthl_status==2)
                                                        <td>
                                                            <form action="{{URL::to('/update-borrow-tthl-status/'.$list_borrow->borrow_tthl_id)}}" method="POST" >
                                                                @csrf
                                                            <select name="borrow_tthl_status" id="borrow_tthl_status" class="badge bg-danger"style="font-size: 13px">
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="2"selected><span class="badge bg-danger">Đang Mượn</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="4"><span>Đã Gia Hạn</span></option>
                                                            </select>
                                                            <button type="submit" class="btn btn-light" name="updated_book">Cập nhật</button>
                                                        </form>
                                                        </td>
                                                    @elseif ($list_borrow->borrow_tthl_status==3)
                                                        <td>
                                                            <form action="{{URL::to('/update-borrow-tthl-status/'.$list_borrow->borrow_tthl_id)}}" method="POST" >
                                                                @csrf
                                                            <select name="borrow_tthl_status" id="borrow_tthl_status" class="badge badge-success" style="font-size: 13px">
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="3"selected><span class="badge badge-success-lighten">Đã Trả</span></option>
                                                            </select>
                                                            <button type="submit" class="btn btn-light" name="updated_book">Cập nhật</button>
                                                        </form>
                                                        </td>
                                                        @elseif ($list_borrow->borrow_tthl_status==4)
                                                        <td>
                                                            <form action="{{URL::to('/update-borrow-tthl-status/'.$list_borrow->borrow_tthl_id)}}" method="POST" >
                                                                @csrf
                                                            <select name="borrow_tthl_status" id="borrow_tthl_status" class="badge badge-warning" style="font-size: 13px">
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="4"selected><span class="badge badge-success-lighten">Đã Gia Hạn</span></option>
                                                                <option id="{{$list_borrow->borrow_tthl_id}}" value="3"><span class="badge badge-success-lighten">Đã Trả</span></option>
                                                            </select>
                                                            <button type="submit" class="btn "name="updated_borrow">Cập nhật</button>
                                                        </form>
                                                        </td>
                                               
                                                @endif
                                                <td>
                                                    <a href="{{URL::to('/edit-borrow-tthl/'.$list_borrow->borrow_tthl_id)}}" title="sửa" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{URL::to('/delete-borrow-tthl/'.$list_borrow->borrow_tthl_id)}}" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
               
                
            </div>
      </div>
@endsection