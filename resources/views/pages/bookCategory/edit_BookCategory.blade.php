@extends('layout')
@section('content')
    <div class="container">
       <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h2 class="mt-5">Cập Nhật Thể Loại Sách</h2>
            @foreach ($edit_BookCategory as $key => $value)
            <form action="{{url('/update-book-category/'.$value->books_category_id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label class="d-flex">Nhập Thể Loại</label>
                    <input type="text" class="form-control" name="books_category_name"  value="{{$value->books_category_name}}">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
    
                <div class="form-group">
                    <label>Tình Trạng</label>
                    <select name="books_category_status" id="">
                        @if($value->books_category_status==2)
                        <option value="1" >Hiện</option>
                        <option value="2" selected>Ẩn</option>
                        @else
                        <option value="1" selected>Hiện</option>
                        <option value="2"  >Ẩn</option>
                        @endif
                    </select>
                </div>
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" name="add_books_category">Thêm</button>
            
            </form>
                
            @endforeach
        </div>
        <div class="col-sm-2"></div>
       </div>
    </div>
@endsection