<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Library Manager | quản lý thư viện</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{asset('/public/backend/image/favicon.ico')}}"> --}}

        <!-- third party css -->
        <link href="{{asset('/public/backend/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">
        <!-- third party css end -->
        <!-- link font  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Link bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         
        {{-- SweetAlert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        {{-- SweetAlert --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- App css -->
        <link href="{{asset('/public/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css">  
        <link href="{{asset('/public/backend/css/main.css')}}" rel="stylesheet" type="text/css">  
        <link href="{{asset('/public/backend/css/stype.css')}}" rel="stylesheet" type="text/css">  
       
        <link href="{{asset('/public/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" >
        <link href="{{asset('/public/backend/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">

        {{-- Datetime --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

        <!-- Datatables css -->
        <link href="{{asset('/public/backend/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/backend/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />

       <style>
        a:hover{
            text-decoration: none;
        }
       </style>

    </head>

    <body  class="loading text-dark" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrappers" style="background-color: #fff">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="{{URL::to('trang-chu')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{url('/public/backend/image/logo.png')}}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{url('/public/backend/image/logo_sm.png')}}" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{URL::to('trang-chu')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{url('/public/backend/image/logo-dark.png')}}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar="">

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Thanh Điều Hướng</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> TRANG CHỦ </span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/trang-chu')}}">Thống Kê</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-title side-nav-item">QUẢN LÝ</li>

                        {{-- document management --}}
                        {{-- <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                                <i class="uil-briefcase"></i>
                                <span> Quản Lý Tài Liệu </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProjects">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url::to('/them-tai-lieu')}}">Thêm Tài Liệu</a>
                                    </li>
                                    <li>
                                        <a href="{{url::to('/danh-sach-tai-lieu')}}">Danh Sách Tài Liệu</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li> --}}
                        {{-- end document management --}}

                         {{-- books management --}}
                         <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span> Quản Lý Sách </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url::to('/thong-ke-sach')}}">Thống Kê Sách</a>
                                    </li>

                                    <li>
                                        <a href="{{url::to('/all-barcodes')}}">Quản lý Mã Vạch</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>

                         {{--End books management --}}

                        <li class="side-nav-item">
                            <a href="{{url::to('/tac-gia')}}" class="side-nav-link">
                                <i class="uil-calender"></i>
                                <span> Quản Lý tác giả </span>
                            </a>
                        </li>

                        

                        <li class="side-nav-item">
                            <a href="{{url::to('/khoa-truc-thuoc')}}" class="side-nav-link">
                                <i class="uil-rss"></i>
                                <span> Quản Lý Đơn Vị </span>
                            </a>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{url::to('/loai-sach')}}" class="side-nav-link">
                                <i class="uil-clipboard-alt"></i>
                                <span> Quản Lý Loại Sách </span>
                            </a>
                        </li>
                         {{--users management  --}}
                         <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce1" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span> Quản Đọc Giả </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce1">
                                <ul class="side-nav-second-level">

                                    <li>
                                        <a href="{{url::to('/register-user')}}">Thêm Độc Giả</a>
                                    </li>
                                    <li>
                                        <a href="{{url::to('/list-users')}}">Danh Sách Độc Giả</a>
                                    </li>

                                    
                                   
                                </ul>
                            </div>
                        </li>
                        {{-- ----------------------------------------------- --}}
                        <li class="side-nav-title side-nav-item">HOẠT ĐỘNG</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="uil-copy-alt"></i>

                                <span> Mượn - Trả </span>
                                <span class="badge bg-secondary text-light float-end">New</span>
                            </a>
                            <div class="collapse" id="sidebarPages">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url::to('/manage-borrow')}}">Danh Sách Mượn</a>
                                    </li>
                                    <li>
                                        <a href="{{url::to('/give-book-back')}}">Danh Sách Trả</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{url::to('/list-borrow-tthl')}}" class="side-nav-link">
                                <i class="uil-clipboard-alt"></i>
                                <span>DS mượn TTHL</span>
                            </a>
                        </li>

                    </ul>

                    
                    <!-- end Help Box -->
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            {{-- lang --}}
                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{url('/public/backend/image/flags/us.jpg')}}" alt="user-image" class="me-0 me-sm-1" height="12"> 
                                    <span class="align-middle d-none d-sm-inline-block">VietNamese</span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <img src="" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                    </a>

                                </div>
                            </li>
                            {{-- end lang --}}

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                        </h5>
                                    </div>

                                    <div style="max-height: 230px;" data-simplebar="">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">1 min ago</small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-account-plus"></i>
                                            </div>
                                            <p class="notify-details">New user registered.
                                                <small class="text-muted">5 hours ago</small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="" class="img-fluid rounded-circle" alt=""> </div>
                                            <p class="notify-details">Cristina Pride</p>
                                            <p class="text-muted mb-0 user-msg">
                                                <small>Hi, How are you? What about our next meeting</small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">4 days ago</small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="" class="img-fluid rounded-circle" alt=""> </div>
                                            <p class="notify-details">Karen Robinson</p>
                                            <p class="text-muted mb-0 user-msg">
                                                <small>Wow ! this admin looks good and awesome design</small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-heart"></i>
                                            </div>
                                            <p class="notify-details">Carlos Crouch liked
                                                <b>Admin</b>
                                                <small class="text-muted">13 days ago</small>
                                            </p>
                                        </a>
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list d-none d-sm-inline-block">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-view-apps noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                                    <div class="p-2">
                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="slack">
                                                    <span>Slack</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="Github">
                                                    <span>GitHub</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="dribbble">
                                                    <span>Dribbble</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="bitbucket">
                                                    <span>Bitbucket</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="dropbox">
                                                    <span>Dropbox</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="" alt="G Suite">
                                                    <span>G Suite</span>
                                                </a>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>

                                </div>
                            </li>
                            {{-- cart --}}
                            <li class="dropdown notification-list d-none d-sm-inline-block" id="show_cart_quantity">
                               
                            </li>
                            {{-- end cart --}}

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <img src="{{url('/public/image/avt24.jpg')}}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name"> <?php
                                            $name = Session::get('admin_name');
                                            if($name){
                                                echo $name ;
                                                session::put('name', null);
                                            }
                                            ?></span>
                                        <span class="account-position">Quản trị</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Tài Khoản của tôi</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Cài Đặt</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lifebuoy me-1"></i>
                                        <span>Hổ Trợ</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{URL::to('/admin-logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Đăng Xuất</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-sm-block float-left">
                            <form action="{{URL::to('/search')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle"  name="keywords_submit" placeholder="Tìm kiếm..." id="keywords_submit">
                                    <span class="mdi mdi-magnify search-icon d-lg-none d-sm-block"></span>
                                    <button class="input-group-text btn-primary d-lg-block d-none" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                            
                        @yield('content')
                    <!-- container -->

                </div>
                <!-- content -->
            </div>
            <!-- End Page content -->
            <!-- ============================================================== -->
            <!-- Footer Start -->
            <footer class="footers" style=" border-top: 1px solid rgba(152,166,173,.2);
                    padding: 19px 24px 20px;
                    display: block;
                    color: #98a6ad;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-4">
                            <script>document.write(new Date().getFullYear())</script> @b1910584 - Nguyen Anh Thu
                        </div>
                        <div class="col-md-4">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="javascript: void(0);"></a>
                                <a href="{{URL::to('/register-user')}}">Hổ Trợ</a>
                                <a href="javascript: void(0);">Liên Hệ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <!-- end Footer -->
        </div>
        <!-- END wrapper -->
        <!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Cài Đặt</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar="">

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Cách tân </strong> lại giao diện sáng, tối và tùy chọn khác nếu bạn muốn
                    </div>

                    <!-- Settings -->
                    <h5 class="mt-3">Màu chủ đề</h5>
                    <hr class="mt-1">

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
                        <label class="form-check-label" for="light-mode-check">Sáng</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
                        <label class="form-check-label" for="dark-mode-check">Tối</label>
                    </div>
        

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Thanh Trạng Thái</h5>
                    <hr class="mt-1">
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                        <label class="form-check-label" for="default-check">Mặc định</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
                        <label class="form-check-label" for="light-check">Sáng</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                        <label class="form-check-label" for="dark-check">Tối</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked="">
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="resetBtn">Trở về mặc định</button>
        
                    </div>
                </div> <!-- end padding-->

            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->
        <!-- bundle -->
          
       
        <script src="{{asset('/public/backend/javascript/vendor.min.js')}}"></script>
        <script src="{{asset('/public/backend/javascript/app.min.js')}}"></script>
        <!-- third party js -->
        <script src="{{asset('/public/backend/javascript/vendor/apexcharts.min.js')}}"></script>
        <script src="{{asset('/public/backend/javascript/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('/public/backend/javascript/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- Datatables js -->
            <script src="{{asset('/public/backend/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('/public/backend/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
            <script src="{{asset('/public/backend/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
            <script src="{{asset('/public/backend/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
            <script src="{{asset('/public/backend/assets/js/pages/demo.datatable-init.js')}}"></script>

            {{-- validate form --}}
            <script src="{{asset('/public/backend/javascript/validateform.js')}}"></script>
            
        <!-- third party js ends -->

        <!-- Datatables js -->


<!-- Datatable Init js -->
<script src="assets/js/pages/demo.datatable-init.js"></script>

    
        {{-- update status borrow book --}}
        <script type="text/javascript">
            $('.borrow_detail_status').change(function(){
                    var order_status = $(this).val();
                    var order_id = $(this).children(":selected").attr("id");    
                    var _token = $('input[name="_token"]').val();
                    // alert(order_status);
                    // lấy ra số lượng
                    quantity = [];
                    $('input[name="book_sales_qty"]').each(function(){
                        quantity.push($(this).val());
                    });

                    // lấy ra book id
                    book_borrow_id = [];
                    $('input[name="book_borrow_id"]').each(function(){
                        book_borrow_id.push($(this).val());
                    });

                    j=0;
                    for(i=0;i<book_borrow_id.length;i++){
                        // so luong muon
                        var book_borrow_qty = $('.order_qty_'+ book_borrow_id[i]).val();
                        // so luong co trong kho
                        var book_qty_storage = $('.book_qty_storage_'+ book_borrow_id[i]).val();
                        if(parseInt(book_borrow_qty)>parseInt(book_qty_storage)){
                            // alert("so luong ban trong kho không đủ");
                            j=j+1;
                            $('.color_qty_'+book_borrow_id[i]).css('background','#B90000');

                        }
                    }
                    $.ajax({
                        url: "{{url('/update-book-borrow-status')}}",
                        method: 'POST',
                        data:{order_status:order_status,order_id:order_id,_token:_token,quantity:quantity,book_borrow_id:book_borrow_id},
                        success: function(data){
                            Swal.fire('Cập nhật trạng thái thành công');
                            location.reload();
                        }
                    });
                   
                   
            });
        </script>

        {{-- Check User --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $('#check_user_code').on('keyup',function(){
                    var user_code = $('input[name="check_user_code"]').val();
                $.ajax({
                    url: "{{url('/check-user')}}",
                    method: 'GET',
                    data:{user_code:user_code},
                    success: function(data){
                        $('#show_name_user').html(data);
                    }
                });
              })
            });
          
        </script>
        {{-- end check user --}}

        {{-- format date --}}
            <script type="text/javascript">
                flatpickr("#pay_day", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    // người mượn hạn cao nhất là 14 ngày 
                    maxDate: new Date().fp_incr(14)
                });
            </script>

        {{-- đếm số lượn tring giỏ chờ mượn sách --}}
        
        {{-- Phần đếm số lượng sản phẩm trong giỏ hàng --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    url: "{{url('/show-cart-quantity')}}",
                    method: 'GET',
                    success: function(data){
                        $('#show_cart_quantity').html(data);
                    }
                });
            });
        
        </script>
      
       {{-- notify value input --}}
       <script>
        $(document).ready(function(){
            // Get value on button click and show alert
            $(".myBtn").click(function(){
                var str = $(".myInput").val();
                var message = "Vui Lòng nhập trường này !"
                $('#message').html(message);
            });
        });
        </script>

    </body>
</html>