@extends('layout')
@section('content')
     <!-- Start Content-->
     <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-11">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item ">Quản Lý Sách</li>
                            <li class="breadcrumb-item mr-4 active">Quản Lý Mã Vạch</li>
                        </ol>
                    </div>
                    <h2 class="page-title" >Quản Lý Mã Vạch</h2>
                    <a target="_blan" href="{{URL('/print-barcode')}}" class="m-1 p-1 bg-primary text-light rounded" title="In Mã Vạch" style="font-size:15px"><i class="fa-solid fa-print"></i></a>
                </div>
               
            </div>

            <?php
            $message = Session::get('message');
            if($message){
                echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                session::put('message', null);
            }
            ?>
            
           
        </div>     
        <!-- end page title --> 
        <div class="row mt-2">
            @forelse ($get_barcodes as $barcode )
                <div data-page-length="5" class="col-4 col-lg-4 col-sm-5 col-md-6 mb-2 border border-dark">
                    <div class="pt-1">
                        {!!$barcode->barcode!!}
                    </div>
                    <span class="d-flex text-center justify-content-center">{{$barcode->books_code}}</span>
                </div>
                @empty
                
            @endforelse
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection