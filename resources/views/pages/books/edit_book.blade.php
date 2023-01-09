@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-2"></div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-8">
                <h2 class="">Cập Nhật Sách</h2>
                @foreach ($edit_book as $key => $val)
                
                <form action="{{url('/update-book/'.$val->books_slug)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="d-flex">Nhập Tên sách</label>
                        <input type="text" class="form-control" name="books_name" value="{{$val->books_name}}">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group">
                        <label class="d-flex">Đặt Đường Dẫn</label>
                        <input type="text" class="form-control" name="books_slug" value="{{$val->books_slug}}">
                        <input type="hidden" class="form-control" name="books_code" value="{{$val->books_code}}">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                   
                    <div class="form-group">
                        <label class="d-flex">Thể Loại Sách</label>
                        <select name="category_of_book" class="form-select" >
                           
                            @foreach ($bookCategory  as $key => $category_book)
                            @if ($category_book->books_category_id == $val->books_category_id)
                                <option selected value="{{$category_book->books_category_id}}">{{$category_book->books_category_name}}</option>
                            @else  
                                <option value="{{$category_book->books_category_id}}">{{$category_book->books_category_name}}</option>

                            @endif   
                           @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="d-flex">Tác Giả Sách</label>
                        <select name="author_of_book" class="form-select" >
                           

                            @foreach ($authors as $key => $authors_of_book)
                            @if ($authors_of_book->authors_id == $val->authors_id)
                                <option selected value="{{$authors_of_book->authors_id}}">{{$authors_of_book->authors_name}}</option>
                            @else  
                                <option value="{{$authors_of_book->authors_id}}">{{$authors_of_book->authors_name}}</option>

                            @endif   
                           @endforeach

                        </select>
                    </div>
                
                    <div class="form-group">
                        <label class="d-flex">Giá Sách</label>
                        <input type="number" class="form-control" name="books_price" value="{{$val->books_price}}">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>

                    <div class="form-group">
                        <label class="d-flex">Số lượng kho</label>
                        <input type="number" class="form-control" name="books_quantity" value="{{$val->books_quantity}}">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>

                    <div class="form-group">
                        <label class="d-flex">Hình Ảnh</label>
                        <input type="file" class="form-control" name="books_image" >
                        <img src="{{ URL::to('public/image/'.$val->books_image)}}" alt="" srcset="" class="mt-1" height="40" width="40" />
                    </div>

                    <div class="form-group">
                        <label class="d-flex">Tình Trạng</label>
                        <select name="books_status" class="form-select" >
                            @if($val->books_status==2)
                            <option value="1" >Hiện</option>
                            <option value="2" selected>Ẩn</option>
                            @else
                            <option value="1" selected>Hiện</option>
                            <option value="2"  >Ẩn</option>
                            @endif
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" name="updated_book">Cập nhật</button>
                
                </form>
                @endforeach
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-2 mb-5"></div>
        </div>
    </div>
@endsection