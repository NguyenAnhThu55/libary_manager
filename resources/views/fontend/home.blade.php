@extends('layout_fontend')
    @section('content_fontend')
    <div class="container">
            <div class="card-block bg-white mb30">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- section-title -->
                        <div class="section-title mb-0">
                            <div class="container">
                                <h2 class="mt-4">Tìm Sách Nhanh</h2>
                                <div class="row">
                                    <div class="col-lg-12 card-margin">
                                        <div class="card search-form">
                                            <div class="card-body p-0">
                                                <form id="search-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row no-gutters">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 p-0">
                                                                    <select class="form-control select_cate" name="value_option" id="exampleFormControlSelect1" style="background-color: none">
                                                                        <option value="0" selected>Từ khóa bất kỳ</option>
                                                                        <option value="1">Nhan đề</option>
                                                                        <option value="2">Tác giả</option>
                                                                        {{-- <option value="3">Chủ đề</option> --}}
                                                                        <option value="4">Năm xuất bản</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-8 col-md-8 col-sm-8 p-0">
                                                                    <input type="text" placeholder="Tìm Kiếm..." class="form-control" id="search" name="search">
                                                                </div>
                                                                <div class="col-lg-1 col-md-1 col-sm-1 p-0">
                                                                  
                                                                    <button type="submit" class="btn btn-base">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="show_search">
                                    
                                    </div>
                                </div>
                        </div>
                        <!-- /.section-title -->
                    </div>
                </div>
            </div>
        </div>
    @endsection