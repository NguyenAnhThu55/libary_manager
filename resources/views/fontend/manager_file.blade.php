@extends('layout_fontend')
    @section('content_fontend')
        <div class="container">
            <div class="card-block bg-white mb30">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- section-title -->
                       <div class="row">
                            <div class="col-8"><h2 class="mt-4">Tài Liệu Điện Tử</h2></div>
                            <div class="col-4">
                               <form action="">
                                @csrf
                                <select name="" id="filter" class="mt-4">
                                    <option value="{{Request::url()}}?sort_by=none">--Lọc Tài Liệu--</option>
                                    <option value="{{Request::url()}}?sort_by=luanvan">Luận Văn Tốt Nghiệp</option>
                                    <option value="{{Request::url()}}?sort_by=nienluannganh">Niên Luận Ngành</option>
                                    <option value="{{Request::url()}}?sort_by=nienluancoso">Niên Luận Cơ sở</option>
                                    <option value="{{Request::url()}}?sort_by=tapchi">Tạp Chí</option>
                                </select>
                               </form>
                            </div>
                       </div>

                       <ul class="list-group list-group-flush">
                        @foreach ($file as $get_file)
                        
                            <li class="list-group-item">
                                <a href="{{URL::to('/detail-file/'.$get_file->soft_document_id)}}">
                                    <span>{{$get_file->soft_document_name}}</span>
                                    <p style="font-size: 13px; color:#323232;">tên tác giả : {{$get_file->soft_document_authors}}</p>
                                </a>
                            </li>
                        @endforeach
                       
                      </ul>
                        <!-- /.section-title -->
                    </div>
                </div>
            </div>
            <div class="d-flex" style="float: right">
                {{$get_file_pdf->links()}}
            </div>
        </div>
    @endsection