@extends('layout')
@section('content')
     <!-- Start Content-->
     <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-10">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item mr-4 active">Quản Lý Đơn Vị</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Quản Lý Ngành TRực Thuộc</h2>
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
                <div class="col-sm-10 col-10">
                    <div class="text-sm-end">
                       
                        <button type="button" class="btn btn-danger mb-2 float-left" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-plus-circle me-2"></i>
                            Thêm Ngành 
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Thêm Ngành Trực Thuộc</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{url('/save-majors')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Tên Ngành</label>
                                                <input type="text" class="form-control" required name="majors_name"  placeholder="vd: Phát Triển Nông Thôn">
                                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                            </div>
                                            
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="add_majors">Thêm</button>
                                        
                                        </form>
                                    </div>
                                   
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                            <thead class="table-light-borrow">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Tên Khoa Trực Thuộc</th>
                                    <th style="width: 155px;">Tùy Chọn</th>
                                </tr>
                            </thead>
                            @php
                                $i=0
                            @endphp
                            <tbody>
                                @foreach ($list_majors as $key => $majors)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                    
                                        <td>
                                            {{$i}}
                                        </td>
                                    
                                        <td>
                                            {{$majors->majors_name}}
                                        </td>
    
                                        <td>
                                           
                                            <a href="{{URL::to('/edit-majors/'.$majors->majors_id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-majors/'.$majors->majors_id)}};" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col-->
           
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection