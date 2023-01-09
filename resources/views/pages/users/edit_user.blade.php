@extends('layout')
@section('content')
    <div class="container">
       <div class="row">
        <div class="col-8">
            <h2 class="mt-5">Cập Nhật Thông Tin Đọc Giả</h2>
            @foreach ($edit_user as $key => $value)
                
                <form action="{{URL::to('/update-user/'.$value->user_id)}}" method="post">
                    @csrf
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Nhập Tên CB/SV</label>
                        <input type="text" id="form2Example1" value="{{$value->user_name}}" name="user_name" class="form-control" />
                      </div>
                      <!-- user_code input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example2">Chức Vụ</label>
                            <select name="user_position" id="">
                                <option value="1">SV</option>
                                <option value="2">CB</option>
                            </select>
                        </div>
                    
                      <!-- student_code input -->
                      <div class="form-outline mb-2">
                          <label class="form-label" for="form2Example2">Mã số CB/SV</label>
                        <input type="text" id="form2Example2" value="{{$value->user_code}}" name="user_code" class="form-control" />
                      </div>
    
                       <!-- user_email input -->
                       <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Email CB/SV</label>
                        <input type="email" id="form2Example2" value="{{$value->user_email}}" name="user_email" class="form-control" />
                         
                        <!-- user_email input -->
                       <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Số điện thoại</label>
                        <input type="text" id="form2Example2" name="user_phone" value="{{$value->user_phone}}" class="form-control" />
                        
                    </div>
                  
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">Cập Nhật</button>
                
                </form>
            @endforeach
        </div>
       </div>
    </div>
@endsection