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
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item mr-4 active">Quản Lý Thể Loại Sách</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Quản Lý Thể Loại Sách</h2>
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
            <div class="col-12">
                <div class="col-sm-10 col-lg-10 col-10">
                    <div class="text-sm-end">
                       
                        <button type="button" class="btn btn-danger mb-2  float-left" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-plus-circle me-2"></i>
                            Thêm Thể Loại
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Thêm Thể Loại</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{url('/save-book-category')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="d-flex">Nhập Thể Loại</label>
                                                <input type="text" required class="form-control" name="books_category_name"  placeholder="vd: giáo trình ngoại ngữ">
                                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                            </div>

                                            <div class="form-group">
                                                <label >Tình Trạng</label>
                                                <select required name="books_category_status" id="">
                                                    <option value="1">Hiện</option>
                                                    <option value="2">Ẩn</option>
                                                </select>
                                            </div>
                                            
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="add_books_category">Thêm</button>
                                        
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
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th>Thể Loại</th>
                                <th>Tình Trạng</th>
                                <th style="width: 155px;">Tùy Chọn</th>
                            </tr>
                        </thead>
                       @php
                           $i=0;
                       @endphp
                        <tbody>
                            @foreach ($list_BookCategory as $key=>$list_bcate)
                                
                            @php
                                $i++;
                            @endphp
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                
                                    <td>
                                        {{$i}}
                                    </td>

                                    <td>
                                        {{$list_bcate->books_category_name}}
                                     </td>
                                    @if ($list_bcate->books_category_status==1)
                                        <td>
                                            {{"Hiển Thị"}}
                                        </td>
                                    @else
                                    <td>
                                        {{"Ẩn"}}
                                    </td>
                                    @endif
                                    

                                    <td>
                                       
                                        <a href="{{URL::to('/edit-book-category/'.$list_bcate->books_category_id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-book-category/'.$list_bcate->books_category_id)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection