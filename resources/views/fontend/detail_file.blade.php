@extends('layout_fontend')
    @section('content_fontend')
        <div class="container">
            <div class="card-block bg-white mb30">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- section-title -->
                      @foreach ($get_detail_pdf as $get_detail)
                        <h2 class="mt-4 text-uppercase"><p class="text-danger">Tài liệu:</p> {{$get_detail->soft_document_name}}</h2>
                        <div class="d-flex">
                            <div>
                                {!!$get_detail->soft_document_desc!!}
                            </div>
                            <div class="justify-content-center text-center">
                                <h4 class="badge bg-primary text-wrap text-uppercase text-center " style="margin-left: 100px">Nội Dung liên quan</h4>
                                <ul class="list-group list-group-flush">
                                   
                                    
                                        <li class="list-group-item">
                                            {{-- <a href="{{URL::to('/detail-file/'.$get_detail->soft_document__id)}}"> --}}
                                                <span>{{$get_detail->soft_document_name}}</span>
                                                <p style="font-size: 13px; color:#6b6868;">tên tác giả : {{$get_detail->soft_document_authors}}</p>
                                            {{-- </a> --}}
                                        </li>
                                   
                                   
                                  </ul>
                            </div>
                        </div>
                      @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    @endsection