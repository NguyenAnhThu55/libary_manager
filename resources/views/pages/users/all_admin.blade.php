@extends('layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="row">
                <div class="col-10">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Thư viện</a></li>
                                <li class="breadcrumb-item ml-2">Phân Quyền</li>
                                <li class="breadcrumb-item mr-4 active">Phân Quyền Tài Khoảng</li>
                            </ol>
                        </div>
                        <h2 class="page-title">Phân Quyền Tài Khoảng</h2>
                    </div>
                </div>

            </div>
           
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>

                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số ĐT</th>
                            {{-- <th>Mật Khẩu</th> --}}
                            <th>Quản Trị</th>
                            <th>Thủ Thư</th>
                            {{-- <th>User</th> --}}

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($admin as $key => $user)
                      <form action="{{url('/assign-roles')}}" method="POST">
                        @csrf
                        <tr>
                         
                          <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                          <td>{{ $user->admin_name }}</td>
                          <td>{{ $user->admin_email }} <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                          <td>{{ $user->admin_phone }}</td>
                          {{-- <td>{{ $user->admin_password }}</td> --}}
                          
                          <td><input type="checkbox" name="admin_role"  {{$user->hasRole('Quản Trị') ? 'checked' : ''}}></td>
                          <td><input type="checkbox" name="user_role"  {{$user->hasRole('Thủ Thư') ? 'checked' : ''}}></td>
          
                        <td>
                            
                              
                           <input type="submit" value="Đổi" class="btn btn-sm btn-default">
                          
                        </td> 
          
                        </tr>
                      </form>
                    @endforeach
                    </tbody>
                </table>
              </div>
              <div style="display: flex">
                {!!$admin->links()!!}
              </div>

        </div>
    </div>
@endsection
