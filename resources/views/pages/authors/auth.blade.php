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
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Thư viện</a></li>
                            <li class="breadcrumb-item mr-4 active">Quản Lý Tác Giả</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Quản Lý Tác Giả</h2>
                </div>
            </div>
       
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                                    session::put('message', null);
                                }
                                ?>
                          
                            <div class="col-sm-10">
                                <div class="text-sm-end">
                                   
                                    <button type="button" class="btn btn-danger mb-2 float-left" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        Thêm Tác Giả
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Thêm Tác Giả</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                    <form action="{{url('/save-authors')}}" name="myForm"  onsubmit="return validateForm()" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="d-flex">Nhập Tên Tác Giả</label>
                                                            <input type="text" class="form-control" name="authors_name fname" required  placeholder="vd: Tố Hữu">
                                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                                        </div>
                                                        
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary" name="add_authors">Thêm</button>
                                                    
                                                    </form>
                                                </div>
                                               
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped dt-responsive nowrap w-100" id="basic-datatable">
                                        <thead class="table-light-borrow">
                                            <tr>
                                                <th style="width: 20px;">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>#</th>
                                                <th>Tên Tác Giả</th>
                                                <th style="width: 155px;">Tùy Chọn</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $i=0;
                                        @endphp
                                        <tbody>
                                            @foreach ($list_authors as $key => $authors)
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
                                                   {{$authors->authors_name}}
                                                </td>
            
                                                <td>
                                                   
                                                    <a href="{{URL::to('/edit-authors/'.$authors->authors_id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-authors/'.$authors->authors_id)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                                
                                         
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection