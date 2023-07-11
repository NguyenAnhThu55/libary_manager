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
                       <div class="text-center">
                            <b class="text-danger">Vui Lòng về <a href="{{URL::to('/thu-vien-khoa-PTNT')}}">TRANG CHỦ</a> Tìm Sách ở Thư Viện Khoa Trước!</b>
                            <p>Nếu không có hãy đăng ký mượn sách ở Trung Tâm Học Liệu <a href="{{URL::to('/subscribe-book')}}">Tại đây</a></p>
                       </div>

                     
                        <!-- /.section-title -->
                    </div>
                </div>
            </div>
            
        </div>
    @endsection