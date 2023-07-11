@extends('layout_fontend')
@section('content_fontend')
    <div class="container">
        <div class="card-block bg-white mb30" >
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- section-title -->
                    <h2 class="mt-4">Thông Tin Bạn Độc</h2>

                    <table class="table table-striped">
                        <thead>
                            <tr style="background-color: lightyellow;">
                                {{-- <th>Hình Ảnh</th> --}}
                                <th>STT</th>
                                <th>Tên Sách</th>
                                <th>Tác giả</th>
                                <th>Ngày Mượn</th>
                                <th>Gia hạn(nếu có)</th>
                                <th>Ngày Trả</th>
                                <th >Tình Trạng</th>
                             </tr>
                            
  
                        </thead>
                             @php
                                  if (Session::get('user_id')){
                                    $i=0;
                                      $id = Session::get('user_id');
                                      $get_info_user = DB::table('tbl_borrow_detail')->join('tbl_borrow_books','tbl_borrow_books.user_id', '=', 'tbl_borrow_detail.user_id')
                                      ->where('tbl_borrow_detail.user_id',$id)->paginate(5);
                                  }
                                    
                             @endphp
                        <tbody>
                            @foreach ( $get_info_user as $user)
                            @php
                                $i++;
                                
                            @endphp
                            <tr>
                                {{-- <td> <img src="{{('public/image/'.{{$user->book_image}})}}" altwidth="40" height="40"></td> --}}
                                <td>{{$i}}</td>
                                <td>{{$user->book_name}}</td>
                                <td>{{$user->authors_name}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->extension}}</td>
                                <td>{{$user->pay_day}}</td>

                                @if ($user->borrow_books_status==0)
                                    <td style="background-color: lightyellow;">Đang Chờ Duyệt</td>
                                    @elseif ($user->borrow_books_status==1)
                                    <td style="background-color: lightyellow;">Đang Mượn</td>

                                    @elseif ($user->borrow_books_status==2)
                                    <td style="background-color: lightyellow;">Đang Gia Hạn</td>
                                    
                                    @elseif ($user->borrow_books_status==3)
                                    <td style="background-color: lightyellow;">Đã Trả</td>
                                    
                                    @elseif ($user->borrow_books_status==4)
                                    <td style="background-color: lightyellow;">Đã Quá Hạn</td>
                                    
                                    @elseif ($user->borrow_books_status==5)
                                    <td style="background-color: lightyellow;">Mất Sách</td>
                                    
                                @endif
                                
             
                            </tr>
                               
                           @endforeach
                         
                        </tbody>
                      </table>
                      {{$get_info_user->links()}}

                    <!-- /.section-title -->
                </div>
            </div>
        </div>
    </div>
@endsection
