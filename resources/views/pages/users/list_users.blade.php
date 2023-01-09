@extends('layout')
@section('content')
     <!-- Start Content-->
     <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-10">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item mr-4 active">Quản Lý Đọc Giả</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Quản Lý Đọc Giả</h2>
                </div>
            </div>
           
        </div>     
        <!-- end page title --> 

        <div class="row">
                <div class="col-sm-10 col-10">
                    <?php
            $message = Session::get('message');
            if($message){
                echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                session::put('message', null);
            }
            ?>
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                            <thead class="table-light-borrow">
                                <tr>
                                   
                                    <th>#</th>
                                    <th>Tên Đọc Giả</th>
                                    <th>Chức Vụ</th>
                                    <th>MSCB/MSSV</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Email</th>
                                    <th style="width: 55px;">Tùy Chọn</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i=0
                                @endphp
                                
                                @foreach ($get_users as $users)
                                @php
                                $i++;
                            @endphp
                                    <tr>
                                       
                                        <td>{{$i}}</td>
                                        <td>
                                                {{$users->user_name}}
                                        </td>
                                        @if ($users->user_position==1)
                                            <td>
                                                SV
                                            </td>
                                        @else
                                            <td>
                                                CB
                                            </td>
                                            
                                        @endif
                                        <td>
                                            {{$users->user_code}}
                                        </td>
                                        <td>
                                            {{$users->user_phone}}
                                        </td>
                                        <td>
                                            {{$users->user_email}}
                                        </td>

                                        <td>
                                            <a href="{{URL::to('/edit-user/'.$users->user_id)}}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');" href="{{URL::to('/delete-user/'.$users->user_id)}}" class="action-icon text-danger text-center" title="Xóa"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col-->
           
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection