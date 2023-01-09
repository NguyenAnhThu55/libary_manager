@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8"><h2 class="mt-5">Cập Nhật Tác Giả</h2>
                @foreach ($edit_authors as $key => $edit)
                    
                <form action="{{URL::to('/update-authors/'.$edit->authors_id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="d-flex">Nhập Tên Tác Giả</label>
                        <input type="text" class="form-control" name="authors_name" value="{{$edit->authors_name}}" >
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    
                  
                    <button type="submit" class="btn btn-primary" name="update_authors">Cập Nhật</button>
                
                </form>
                @endforeach</div>
            <div class="col-sm-2"></div>
        </div>
    </div>
@endsection