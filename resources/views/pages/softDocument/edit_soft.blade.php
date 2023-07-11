@extends('layout')
@section('content')
    <div class="container">
       <div class="row">
            <div class="col-10 col-lg-10 col-sm-10">
                <h2>Cập Nhật Tài Liệu</h2>
                @foreach ($edit_book_soft as $edit)
                
                    <form action="{{ url('/update-book-soft/'.$edit->soft_document_id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex">Loại Tài Liệu</label>
                            <select name="soft_document_category" class="form-select">
                                @if ($edit->soft_document_category==1)
                                <option value="1" selected>Luận Văn</option>
                                <option value="2">Niên Luận Ngành</option>
                                <option value="3">Niên Luận Cơ Sở</option>
                                <option value="4">Tạp Chí</option>
                                    @elseif ($edit->soft_document_category==2)
                                    <option value="1">Luận Văn</option>
                                    <option value="2" selected>Niên Luận Ngành</option>
                                    <option value="3">Niên Luận Cơ Sở</option>
                                    <option value="4">Tạp Chí</option>
                                    @elseif ($edit->soft_document_category==3)
                                    <option value="1">Luận Văn</option>
                                    <option value="2" >Niên Luận Ngành</option>
                                    <option value="3"selected>Niên Luận Cơ Sở</option>
                                    <option value="4">Tạp Chí</option>

                                    @elseif ($edit->soft_document_category==4)
                                    <option value="1">Luận Văn</option>
                                    <option value="2" >Niên Luận Ngành</option>
                                    <option value="3">Niên Luận Cơ Sở</option>
                                    <option value="4"selected>Tạp Chí</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-flex">Nhập Tên sách</label>
                            <input type="text" class="form-control myInput" required name="soft_name"
                            value="{{$edit->soft_document_name}}">

                            <input type="hidden" name="soft_code" value="{{$edit->soft_document_code}}">
                        </div>
                
                        <div class="form-group">
                            <label class="d-flex">Nhập Tác Giả</label>
                            <textarea type="text" class="form-control myInput" required name="soft_authors" placeholder="nhập nội dung...">{{$edit->soft_document_authors}}</textarea>
                
                        </div>
                
                        <div class="form-group">
                            <label class="d-flex">Nhập Nội Dung</label>
                            <textarea type="text" class="form-control myInput" required name="soft_desc" placeholder="nhập nội dung...">{{$edit->soft_document_desc}}</textarea>
                
                        </div>
                
                        <div class="form-group">
                            <label class="d-flex">Tình Trạng</label>
                            <select name="soft_status" class="form-select">
                                @if ($edit->soft_document_status==1)
                                    <option value="1" selected>Hiện</option>
                                    <option value="2">Ẩn</option>
                                    @elseif ($edit->soft_document_status==2)
                                    <option value="1" >Hiện</option>
                                    <option value="2"selected>Ẩn</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" name="updated_book_soft">Cập nhật</button>
                    </form>

                @endforeach
            </div>
       </div>
    </div>
@endsection