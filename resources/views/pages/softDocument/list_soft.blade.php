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
                            <li class="breadcrumb-item mr-4 active">Thống Kê</li>
                        </ol>
                    </div>
                    <h2 class="page-title">Quản Lý Sách Điện Tử</h2>

                </div>
            </div>



        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-11">
                
            <?php
            $message = Session::get('message');
            if($message){
                echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                session::put('message', null);
            }
            ?>
                <div class="text-end">
                    <button type="button" class="btn btn-danger mb-2  float-left" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class="mdi mdi-plus-circle me-2"></i>
                        Thêm Sách
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Thêm Sách Điện Tử</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="width:90%;">
                                    <form action="{{ url('/save-book-soft') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="d-flex">Loại tài liệu</label>
                                            <select name="soft_document_category" class="form-select">
                                                <option value="1">Luận Văn</option>
                                                <option value="2">Niên Luận Ngành</option>
                                                <option value="3">Niên Luận Cơ Sở</option>
                                                <option value="4">Tạp Chí</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="d-flex">Nhập Tên sách</label>
                                            <input type="text" class="form-control myInput" required name="soft_name"
                                                placeholder="vd: giáo trình ngoại ngữ">
                                        </div>

                                        <div class="form-group">
                                            <label class="d-flex">Nhập Tác Giả</label>
                                            <textarea type="text" class="form-control myInput" required name="soft_authors" placeholder="nhập nội dung..."></textarea>

                                        </div>

                                        <div class="form-group">
                                            <label class="d-flex">Nhập Nội Dung</label>
                                            <textarea type="text" class="form-control myInput" required name="soft_desc" placeholder="nhập nội dung..."></textarea>

                                        </div>

                                        <div class="form-group">
                                            <label class="d-flex">Tình Trạng</label>
                                            <select name="soft_status" class="form-select">
                                                <option value="1">Hiện</option>
                                                <option value="2">Ẩn</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary myBtn" name="add_book_soft">Thêm</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            
                <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                        <thead class="table-light-borrow">
                            <tr>
                                <th>STT</th>
                                <th>Tên Tài liệu</th>
                                <th>Loại</th>
                                <th>Mã Tài liệu</th>
                                <th>Tên Tác Giả</th>
                                <th>Tình trạng</th>

                                <th style="width: 155px;">Tùy Chọn</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($get_soft as $soft)
                                @php
                                    $i++;
                                @endphp
                                <tr class="">

                                    <td>

                                        {{$i}}
                                    </td>

                                    <td>
                                        {{$soft->soft_document_name}}
                                    </td>
                                    @if($soft->soft_document_category==1)
                                    <td>
                                        Luận Văn
                                    </td>
                                    @elseif($soft->soft_document_category==2)
                                    <td>
                                        Niên Luận Ngành
                                    </td>
                                    @elseif($soft->soft_document_category==3)
                                    <td>
                                        Niên Luận Cơ Sở
                                    </td>
                                    @else
                                    <td>Tạp Chí</td>
                                    @endif
                                   

                                    <td>
                                        {{$soft->soft_document_code}}
                                    </td>

                                    <td>
                                        {{$soft->soft_document_authors}}
                                    </td>

                                    @if($soft->soft_document_status==1)
                                        <td>
                                            Hiện
                                        </td>
                                        @else
                                        <td>
                                            Ẩn
                                        </td>
                                    @endif




                                    <td>
                                        <a href="{{URL::to('/edit-book-soft/'.$soft->soft_document_id)}}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-book-soft/'.$soft->soft_document_id)}}" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                
                            @endforeach



                           

                        </tbody>
                    </table>

                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    @endsection
