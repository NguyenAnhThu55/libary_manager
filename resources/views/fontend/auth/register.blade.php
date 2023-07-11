<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thư Viện Khoa Phát Triển Nông Thôn</title>
    <!-- link font -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/public/fontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/public/fontend/css/chat.css')}}">
    <link rel="stylesheet" href="{{asset('/public/fontend/css/search.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <!-- link bootstrap -->
       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
       <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <!------ Include the above in your HEAD tag ---------->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <!-- link font -->
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
    ></script>

<style>
    div.form-outline .form-control {
    min-height: auto;
    padding: 0.32rem 0.75rem;
    border: 1px solid #cccccc;
    background: transparent;
    transition: all .2s linear;
  }
  input:focus~label,
  input:valid~label{
    top:-15px;
  }
</style>
</head>
<body>
    <div class="page-header">
        <div class="fixed-top">
          <nav class="navbar navbar-expand-lg navbar-expand-sm navbar-dark mx-background-top-linear">
            <div class="container">
              <a class="navbar-brand" rel="nofollow" href="{{URL::to('/thu-vien-khoa-PTNT')}}" style="text-transform: uppercase;">thư viên khoa PTNT</a>
              
              <div class="collapse navbar-collapse" id="">
        
                <ul class="navbar-nav ml-auto">
        
                  <li class="nav-item active">
                    <a class="nav-link" href="{{URL::to('/thu-vien-khoa-PTNT')}}">Trang Chủ
                      <span class="sr-only">(current)</span>
                    </a>
                  </li>
        
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/manager-file')}}">tài liệu điện tử</a>
                  </li>
        
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/subscribe-to-books')}}">mượn sách</a>
                  </li>
        
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/auth')}}">Đăng ký / đăng nhập</a>
                  </li>
        
                </ul>
              </div>
            </div>
          </nav>
          
        </div>
          
      </div>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h2 fw-bold mb-2 mx-1 mx-md-4 mt-4">Đăng Ký</p>
                      <?php
                      $message = Session::get('message');
                      if($message){
                          echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                          session::put('message', null);
                      }
                      ?>
                      <form class="mx-1 mx-md-4" action="{{URL::to('/register')}}" method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">Họ và Tên</label>
                            <input type="text" id="" class="form-control" style="border:1" name="user_name"/>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-2">
                          
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">Email</label>
                            <input type="email" id="" class="form-control" name="user_email"/>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fa fa-id-badge fa-lg me-3 fa-fw" aria-hidden="true"></i>
                          <div class="form-outline flex-fill mb-0">
                            <select name="user_position" id="">
                              <option value="1">Cán Bộ</option>
                              <option value="2">Sinh Viên</option>
                            </select>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fa fa-address-card fa-lg me-3 fa-fw" aria-hidden="true"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">MSCV/MSSV</label>
                            <input type="text" id="" class="form-control" name="user_code"/>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fa fa-phone-square fa-lg me-3 fa-fw" aria-hidden="true"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">số điện thoại</label>
                            <input type="text" id="" class="form-control" name="user_phone"/>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">Mật Khẩu</label>
                            <input type="password" id="" class="form-control" name="password"/>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-2">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <label class="" for="">Nhập lại mật khẩu</label>
                            <input type="password" id="" class="form-control" name="password_repeat" />
                          </div>
                        </div>
      
                        <div class="form-check d-flex justify-content-center mb-2">
                         
                          <label class="form-check-label" for="form2Example3">
                            Nếu đã có tài khoảng vui lòng <a href="{{URL::to('/login-auth')}}">Đăng nhập</a>
                          </label>
                        </div>
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-primary btn-lg">Đăng Ký</button>
                        </div>
      
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="{{asset('/public/fontend/image/draw1.webp')}}"
                        class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>