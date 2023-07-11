@extends('layout')
@section('content')
                        
      <div class="container">
            <div class="row m-1">
                  <div class="col-8"><h2 class="mt-3 mb-2">Thống Kê Danh Sách</h2></div>
                  <div class="col-3 mt-3 app-search dropdown d-none d-lg-block">
                    </div>
            </div>
            <div class="row">
                  
                  <div class="col-sm-1">
                        
                  </div>
                  <div class="col-sm-10">
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                            session::put('message', null);
                        }
                        ?>
                        <div class="" id="manage_borrow">
                              <select name="" id="list_manage_borrow" class="form-select mb-2">
                                    <option value="">--- Tìm theo danh sách ---</option>
                                    <option value="1">Danh sách mượn</option>
                                    <option value="2">Danh sách gia hạn</option>
                                    <option value="3">Danh sách Trả</option>
                                    <option value="4">Danh sách Quá Hạn</option>
                                    <option value="5">Danh sách mất sách</option>
                              </select>
                        </div>
                        <div class="table-responsive" id="list_search_borrow">
                             
                        </div>

                        <div class="table-responsive" id="list_id_borrow">
                              <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                                  <thead class="table-light-borrow">
                                      <tr>
                                          <th>#</th>
                                          <th>Tên Người Mượn</th>
                                          <th>Ngày Mượn</th>
                                          <th>Ngày trả</th>
                                          <th>Gia Hạn(+7 ngày)</th>
                                          <th>Tình Trạng</th>
                                          <th style="width: 100px;">Tùy Chọn</th>
                                      </tr>
                                  </thead>
                                    @php
                                          $i=0;
                                    @endphp
                                    <tbody>
            
                                          @foreach ($manage_borrow_books as $key => $list_borrow)
                                                @php
                                                $i++;
                                                @endphp
                                                <tr>        
                                                      <td>
                                                            {{$i}}
                                                      </td>
                                                
                                                      <td>
                                                            {{$list_borrow->user_name}}
                                                      </td>
            
                                                      <td>
                                                            {{$list_borrow->created_at}}
                                                      </td>
            
                                                      <td>
                                                            {{$list_borrow->pay_day}}
                                                      </td>
                                                      <td>
                                                            {{$list_borrow->extension}}
                                                      </td>
                                                      @if ($list_borrow->borrow_books_status==0)
                                                                  <td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ duyệt</span></td>
                                                            @elseif ($list_borrow->borrow_books_status==1)
                                                                  <td><span class="badge bg-danger">Đang Mượn</span></td>
                                                            @elseif ($list_borrow->borrow_books_status==2)
                                                                  <td><span class="badge badge-warning-lighten">Đã Gia Hạn</span></td>
                                                            @elseif ($list_borrow->borrow_books_status==3)
                                                                  <td><span class="badge badge-success-lighten">Đã Trả</span></td>
                                                                  @elseif ($list_borrow->borrow_books_status==4)
                                                                  <td><span class="badge badge-info-lighten">Quá Hạn</span></td>
                                                                  @elseif ($list_borrow->borrow_books_status==5)
                                                                  <td><span class="badge badge-danger-lighten">Mất Sách</span></td>
                                                      @endif
                                                     
                                                
            
                                                      <td>
                                                            <a href="{{URL::to('/view-borrow-detail/'.$list_borrow->borrow_books_id)}}" class="action-icon text-success" title="Xem chi tiết"><i class="far fa-eye"></i></a>
                                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-borrow-book/'.$list_borrow->borrow_books_id)}}" class="action-icon text-danger" title="Xóa"> <i class="mdi mdi-delete"></i></a>
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