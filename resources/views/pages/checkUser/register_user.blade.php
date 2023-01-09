@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            {{-- <div class="col-sm-4"></div> --}}
            <div class="col-sm-8 col-md-8 col-lg-4">
                <form class="mt-3" action="{{URL::to('/add-user')}}" method="POST">
                    @csrf
                    <h4 class="m-3">ĐĂNG KÝ TÀI KHOẢNG MƯỢN SÁCH</h4>
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Nhập Tên CB/SV</label>
                        <input type="text" id="form2Example1" name="user_name" class="form-control" />
                      </div>
                        <!-- user_code input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example2">Chức Vụ</label>
                            <select name="user_position" id="">
                                <option value="1">SV</option>
                                <option value="2">CB</option>
                            </select>
                        </div>
                      <!-- user_code input -->
                      <div class="form-outline mb-2">
                          <label class="form-label" for="form2Example2">Mã số CB/SV</label>
                        <input type="text" id="form2Example2" name="user_code" class="form-control" />
                      </div>

                       <!-- user_email input -->
                       <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Email CB/SV</label>
                        <input type="email" id="form2Example2" name="user_email" class="form-control" />
                         
                        <!-- user_email input -->
                       <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Số điện thoại</label>
                        <input type="text" id="form2Example2" name="user_phone" class="form-control" />
                        
                    </div>
                  
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">Đăng Ký</button>
                </form>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-6"></div>
        </div>
        
    </div>
@endsection