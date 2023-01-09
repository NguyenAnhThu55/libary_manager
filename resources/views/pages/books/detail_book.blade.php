@extends('layout')
@section('content')
<div class="row">
    <div class="col-xxl-12 col-lg-8">
        <!-- project card -->
        <div class="card d-block">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="dripicons-dots-3"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                        <!-- item-->
                    </div>
                </div>
                <!-- project title-->
                <h3 class="mt-0">
                    Phần tên của cuốn sách
                </h3>
                <div class="badge bg-secondary text-light mb-3">Thể Loại</div>

                <h5>Hình Ảnh Sách</h5>

               <div class="m-4">
                    <img  src="{{asset('/public/backend/image/projects/project-1.jpg')}}" class="img-thumbnail" alt="">
               </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>Ngày Nhập Sách</h5>
                            <p>17 March 4018 <small class="text-muted">1:00 PM</small></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>tác giả</h5>
                            <p>$15,800</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>Thể Loại</h5>
                            <p>$15,800</p>
                        </div>
                    </div>

                    
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>Khoa trực thuộc</h5>
                            <p>$15,800</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>Giá cuốn sách</h5>
                            <p>$15,800</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5>ID sách</h5>
                            <p>$15,800</p>
                        </div>
                    </div>
                </div>

                

            </div> <!-- end card-body-->
            
        </div> <!-- end card-->

        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 mb-3">Bình Luận (258)</h4>

                <textarea class="form-control form-control-light mb-2" placeholder="Write message" id="example-textarea" rows="3"></textarea>
                <div class="text-end">
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="dripicons-paperclip"></i></button>
                    </div>
                    <div class="btn-group mb-2 ms-2">
                        <button type="button" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </div>

              
                
            </div> <!-- end card-body-->
        </div>
        <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection