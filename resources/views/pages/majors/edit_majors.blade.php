@extends('layout')
@section('content')
    <div class="container">
        <h2 class="mt-5">Cập Nhật Khoa Trực Thuộc</h2>
        @foreach ($edit_majors as $key => $value)
            
        <form action="{{URL::to('/update-majors/'.$value->majors_id)}}" method="post">
            @csrf
            <div class="form-group">
                <label class="d-flex">Nhập Tên Khoa</label>
                <input type="text" class="form-control" name="majors_name" value="{{$value->majors_name}}" >
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
            
          
            <button type="submit" class="btn btn-primary" name="update_majors">Cập Nhật</button>
        
        </form>
        @endforeach
    </div>
@endsection