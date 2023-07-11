@extends('layout')
    @section('content')
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        
                        <h4 class="page-title">Trang Chủ</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="" id="donut"></div>
                    <p class="donut-text">Biểu đồ thống kê</p>
                </div>


                <div class="col-xl-8 col-lg-8">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Tổng Số Đọc Giả</h5>
                                    <?php
                                    $total_user = DB::table('tbl_users')->get();
                                    $count = 0;
                                   
                                    ?>
                                    <h3 class="mt-3 mb-3">{{count($total_user)}}</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> người</span>
                                        <span class="text-nowrap">Kể Từ Tháng Này</span>  
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Đang Mượn</h5>
                                    <?php
                                    $total_borrowing = DB::table('tbl_borrow_books')
                                    ->where('borrow_books_status','=',1)->get();
                                    $sum = 0;
                                   
                                    ?>
                                    <h3 class="mt-3 mb-3">{{count($total_borrowing)}}</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> người</span>
                                        <span class="text-nowrap">Kể Từ Tháng Này</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Vi Phạm</h5>
                                    <?php
                                    $total = DB::table('tbl_borrow_books')
                                    ->where('borrow_books_status','=',4)->orwhere('borrow_books_status','=', 5)->get();
                                    $sum = 0;
                                   
                                    ?>
                                    <h3 class="mt-3 mb-3">{{count($total)}}</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> người</span>
                                        <span class="text-nowrap">Kể Từ Tháng Này</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                       
                                        <i class="fas fa-book widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Growth">Tổng số Sách</h5>
                                    <?php
                                    $total_books = DB::table('tbl_books')->sum('books_quantity');
                                    $sum = 0;
                                   
                                    ?>
                                  
                                        <h3 class="mt-3 mb-3">{{$total_books}}</h3>
                                    
                              
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> sách</span>
                                        <span class="text-nowrap">Kể Từ Tháng Này</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end col -->


            </div>
            <!-- end row -->
        </div>
         {{-- biểu đồ thống kê --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        var colorDanger = "#FF1744";
        Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#E6E6FA',
                '#FF00FF',
                '#8A2BE2',
                '#6169d0',
                '#4B0082'
            ],
            //labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [{
                    label: "Độc Giả",
                    value: {{$user}}
                    
                },
                {
                    label: "Đang Mượn",
                    value: {{$borrow}}
                },
                {
                    label: "Tổng Sách",
                    value: {{$books}}
                },
                {
                    label: "Quản Trị",
                    value: {{$total_admin}}
                },
                {
                    label: "Vi Phạm",
                    value: {{$violations}},
                    color: colorDanger
                }
            ]
        });
    </script>
    @endsection

