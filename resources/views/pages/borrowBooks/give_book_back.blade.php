@extends('layout')
@section('content')
                        
      <div class="container">
            <div class="row">
                  <?php
                  $message = Session::get('message');
                  if($message){
                      echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                      session::put('message', null);
                  }
                  ?>
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                        <h2 class="mt-3 mb-2">Thông Tin Trả Sách</h2>
                        <div class="table-responsive">
                              <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                                  <thead class="table-primary">
                                      <tr>
                                          <th>#</th>
                                          <th>Tên Người Trả</th>
                                          <th>SĐT Người Trả</th>
                                          <th>Ngày Mượn</th>
                                          <th>Ngày trả</th>
                                          <th>Tình Trạng</th>
                                          <th style="width: 100px;">Tùy Chọn</th>
                                      </tr>
                                  </thead>
                                    @php
                                          $i=0;
                                    @endphp
                                    <tbody>
            
                                          @foreach ($give_book as $key => $give)
                                                @php
                                                $i++;
                                                @endphp
                                                <tr>        
                                                      <td>
                                                            {{$i}}
                                                            
                                                      </td>
                                                
                                                      <td>
                                                            {{$give->user_name}}
                                                      </td>
            
                                                      <td>
                                                            {{$give->user_phone}}
                                                      </td>
            
                                                      <td>
                                                            {{$give->created_at}}
                                                      </td>
            
                                                      <td>
                                                            {{$give->pay_day}}
                                                      </td>
            
                                                   
                                                      <td><span class="badge badge-success-lighten">Đã Trả</span></td>
            
                                                      <td>
                                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{URL::to('/delete-give-book-back/'.$give->borrow_book_id)}}" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                                                      </td>
                                                </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  <div class="col-sm-1"></div>
            </div>

           
      </div>
@endsection