@extends('layout_fontend')
    @section('content_fontend')
        <div class="container">
            <div class="card-block bg-white mb30">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- section-title -->
                       <div class="row text-center">
                            <div class="col-12"><h2 class="mt-4">Đăng Ký mượn Sách tại Trung Tâm Học Liệu</h2></div>
                           
                       </div>
                       <?php
                       $message = Session::get('message');
                       if($message){
                           echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                           session::put('message', null);
                       }
                       ?>
                       <div>
                        <div class="mb-3 text-dark">
                            <label for="example-select" class="form-label">Chọn số lượng mượn</label>
                            <select class="form-select chose-number" id="example-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <form action="{{URL::to('/dang-ky-muon-online')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 ">
                                <label for="example-palaceholder" class="form-label text-dark">Nhập tên Sách (1)</label>
                                <input type="text" id="example-palaceholder" name="book_tthl_name" required class="form-control" placeholder="name book ...">
                            </div>

                                <div class="mb-3 ml-5">
                                    <label for="example-palaceholder" class="form-label text-dark">Nhập tên tác giả Sách (nếu có)</label>
                                    <input type="text" id="example-palaceholder" name="authors_tthl_name" class="form-control" placeholder="...">
                                </div>

                            <div class="show">
                            {{-- show chọn số lượng sách mượn --}}
                            </div>
                            
                            <button type="submit" class="mt-4 btn btn-warning btn-lg text-white">Mượn</button>
                        </form>
                       </div>
                        <!-- /.section-title -->
                    </div>
                </div>
            </div>
            
        </div>
    @endsection