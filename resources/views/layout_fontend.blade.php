<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Thư Viện Khoa Phát Triển Nông Thôn</title>
    <!-- link bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- link font -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/public/fontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/fontend/css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/fontend/css/search.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('/public/fontend/css/status_user.scss')}}">


    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        select.form-control:not([size]):not([multiple]) {
          height: calc(3.25rem + 2px);
          border: 1px solid #cdd400;
          color: #000;
          max-width: 85%;
          background-color: #fff;
          padding: 12px
  
          }
      </style>
</head>

<body>


    <!-- page-header -->
    <div class="page-header">
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-expand-sm navbar-dark mx-background-top-linear">
                <div class="container">
                    <a class="navbar-brand" rel="nofollow" href="{{ URL::to('/thu-vien-khoa-PTNT') }}"
                        style="text-transform: uppercase;">thư viên khoa PTNT</a>

                    <div class="collapse navbar-collapse" id="" style="text-transform: uppercase;">

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item active">
                                <a class="nav-link" href="{{ URL::to('/thu-vien-khoa-PTNT') }}">Trang Chủ
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/manager-file') }}">tài liệu điện tử</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/subscribe-to-books') }}">mượn sách</a>
                            </li>

                            @if (Session::get('user_id'))
                                {{-- <li class="nav-item">
                                  <a class="nav-link" href="{{ URL::to('/logout') }}"></a>
                              </li> --}}
                             
                              <div class="dropdown">
                                <button style="background-color: #cdd400;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  {{Session::get('user_name');
                                  }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{ URL::to('/status') }}">Thông tin bạn độc</a>
                                  <a class="dropdown-item" href="{{ URL::to('/logout') }}">Đăng Xuất</a>
                                </div>
                              </div>
                               
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/auth') }}">Đăng ký / đăng nhập</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                        <h1 class="page-title" style="margin-top: -60px">Thư Viện Khoa Phát Triển Nông Thôn</h1>
                        <div class="col-sm-12 page-title">
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- /.page-header-->
    <!-- news -->
    <div class="card-section" style="bottom:120px;">
        @yield('content_fontend')
    </div>
    </div>
    <hr>
    {{-- Phần chatbot --}}
    <a href="" class="chat" style="">
        <i class="fa fa-commenting" style="" aria-hidden="true">
            <span class="span_chat" style="">0</span>
        </i>
    </a>
    <footer class="footers" style="top:0px;color:#000;">
        <div class="container ">
            <div class="row">
                <div class="col-md-12 d-flex" style="justify-content: space-between">
                    <b>Thông tin</b>
                    <b>Trực Thuộc</b>
                    <b>Ngành Học</b>
                </div>
                <div class="col-md-12 d-flex" style="justify-content: space-between">
                    <div class="d-block">Giáo Viên Hướng Dẫn : <b>Sử Kim Anh</b></div>
                    <div class="">Đoàn Khoa Phát Triển Nông Thôn</div>
                    <div>Công Nghệ Thông Tin</div>

                </div>

                <div class="col-md-12 d-flex" style="justify-content: space-between">
                    <div class="d-block">Sinh Viên Thực Hiện : <b>Nguyễn Anh Thư</b></div>
                    <script>
                        document.write(new Date().getFullYear())
                    </script>



                </div>
                <div class="col-md-12 d-flex" style="justify-content: space-between">
                    <div class="">MSSV : B1910584</div>
                </div>
            </div>

        </div>
    </footer>


    {{-- search --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var search = $('input[name="search"]').val();
                var value_option = $('select[name="value_option"]').val();
                //  alert (search);
                //  alert (value_option);
                $.ajax({
                    url: "{{url('/search-list-fontend')}}",
                    method: 'GET',
                    data: {
                        search:search,value_option:value_option
                    },
                    success: function(data) {
                        $('#show_search').html(data);
                    }
                });

            })
        });
    </script>
    {{-- end  --}}

   
    {{-- Phần Lọc Tài liệu --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#filter').on('change', function() {
                var url = $(this).val();
                // alert (url)
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>
    {{-- end --}}

    {{-- Chọn số lượn sách mượn onl ở trung tâm học liệu --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.chose-number').on('change', function() {
                var number = $(this).val();
                // alert (number)
                $.ajax({
                    url: "{{url('/chose-number')}}",
                    method: 'GET',
                    data: {
                        number: number
                    },
                    success: function(data) {
                        $('.show').html(data);
                    }
                });

            });
        });
    </script>
    {{-- end --}}

   
</body>

</html>
