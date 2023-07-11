@extends('layout')
@section('content')
    <div class="container">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item ml-2"><a href="javascript: void(0);">Thư viện</a></li>
                                <li class="breadcrumb-item mr-4 active">DS mượn TTHL</li>
                            </ol>
                        </div>
                        <h2 class="page-title">Danh Sách Mượn Từ Trung Tâm Học Liệu</h2>
                    </div>
                </div>


                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
                    session::put('message', null);
                }
                ?>
            </div>
            <div class="row">

                <div class="col-sm-12">
                    <div class="text-sm-end">

                        <button type="button" class="btn btn-danger mb-2  float-left" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="mdi mdi-plus-circle me-2"></i>
                            Thêm Sách mượn
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width:576px" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Thêm Sách mượn ở TTHL</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body show" style="width: 98%;margin-left: 12px;">
                                        <form action="{{ url('/save-borrowing-tthl') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3 ">
                                                <label for="example-palaceholder" class="form-label text-dark">Nhập
                                                    tên</label>
                                                <input type="text" id="example-palaceholder" name="sv_tthl_name" required
                                                    class="form-control" placeholder="name ...">
                                            </div>
                                            <div class="mb-3 ">
                                                <label for="example-palaceholder" class="form-label text-dark">Nhập
                                                    MSSV/MSCB</label>
                                                <input type="text" id="example-palaceholder" name="mssv_tthl_name"
                                                    required class="form-control" placeholder="code ...">
                                            </div>
                                            <div class="mb-3 ">
                                                <label for="example-palaceholder" class="form-label text-dark">Nhập
                                                    mail</label>
                                                <input type="text" id="example-palaceholder" name="email_sv" required
                                                    class="form-control" placeholder="eamil ...">
                                            </div>
                                            <div class="">
                                                <div class="mb-3 ">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập tên
                                                        Sách (1)</label>
                                                    <input type="text" id="example-palaceholder" name="book_tthl_name"
                                                        required class="form-control" placeholder="name book (1) ...">
                                                </div>

                                                <div class="mb-3 ml-5">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập tên
                                                        tác giả Sách (nếu có)</label>
                                                    <input type="text" id="example-palaceholder" name="authors_tthl_name"
                                                        class="form-control" placeholder="...">
                                                </div>

                                                <div class="mb-3 ">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập tên
                                                        Sách (2)</label>
                                                    <input type="text" id="example-palaceholder" name="book_tthl_name2"
                                                        class="form-control" placeholder="name book (2)...">
                                                </div>

                                                <div class="mb-3 ml-5">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập tên
                                                        tác giả Sách (nếu có)</label>
                                                    <input type="text" id="example-palaceholder"
                                                        name="authors_tthl_name2" class="form-control" placeholder="...">
                                                </div>

                                                <div class="mb-3 ">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập
                                                        tên Sách (3)</label>
                                                    <input type="text" id="example-palaceholder"
                                                        name="book_tthl_name3" class="form-control"
                                                        placeholder="name book (3)...">
                                                </div>

                                                <div class="mb-3 ml-5">
                                                    <label for="example-palaceholder" class="form-label text-dark">Nhập
                                                        tên tác giả Sách (nếu có)</label>
                                                    <input type="text" id="example-palaceholder"
                                                        name="authors_tthl_name3" class="form-control" placeholder="...">
                                                </div>


                                                {{-- show chọn số lượng sách mượn --}}
                                            </div>

                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary myBtn"
                                                name="add_borrow_tthl">Thêm</button>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- end col-->

                <div class="" id="manage_borrow_tthl">
                    <select name="" id="list_manage_borrow_tthl" class="form-select mb-2">
                        <option value="">--- Tìm theo danh sách ---</option>
                        <option value="0">Danh sách đang chờ</option>
                        <option value="1">Danh sách đang mượn</option>
                        <option value="2">Danh sách đã trả</option>
                    </select>
                </div>

                
                <div class="table-responsive" id="list_search_borrow_tthl">
                    

                </div>

                <div class="table-responsive" id="list_borrow_tthl">
                    <table class="table table-striped dt-responsive nowrap w-100" data-page-length="5">
                        <thead class="table-light-borrow">
                            <tr>
                                <th>#</th>
                                <th>Tên Người Mượn</th>
                                <th>MSSV</th>
                                {{-- <th>Tên Sách</th>
                                    <th>Tên Tác Giả: </th>
                                    <th>Tên Sách</th>
                                    <th>Tên Tác Giả: </th>
                                    <th>Tên Sách</th>
                                    <th>Tên Tác Giả: </th> --}}
                                <th>Ngày đk Mượn</th>
                                <th>Ngày Mượn</th>
                                <th>Ngày Trả</th>
                                <th>Tình Trạng</th>


                                <th style="width: 150px;">Tùy Chọn</th>
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>

                            @foreach ($list_user_borrow_tthl as $key => $list_borrow)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    {{-- stt --}}
                                    <td>{{ $i }}</td>
                                    {{-- ten nguoi mượn --}}
                                    <td>
                                        {{ $list_borrow->user_name }}
                                    </td>
                                    {{-- maso --}}
                                    <td>
                                        {{ $list_borrow->ma_sv }}
                                    </td>

                                    {{-- Ngày đk mượn --}}
                                    <td>
                                        {{ $list_borrow->borrow_registration_date }}
                                    </td>

                                    {{-- Ngày mượn --}}
                                    <td>
                                        {{ $list_borrow->borrow_day }}
                                    </td>

                                    {{-- Ngày mượn --}}
                                    <td>
                                        {{ $list_borrow->pay_date }}
                                    </td>

                                    {{-- tình trạng --}}

                                    @if ($list_borrow->borrow_tthl_status == 0)
                                        <td><span class="badge badge-info-lighten" style="font-size: 13px">Đang chờ</span>
                                        </td>
                                    @elseif ($list_borrow->borrow_tthl_status == 1)
                                        <td><span class="badge bg-danger">Đang Mượn</span></td>
                                    @elseif ($list_borrow->borrow_tthl_status == 2)
                                        <td><span class="badge badge-warning-lighten">Đã Trả</span></td>
                                    @endif



                                    {{-- tùy chọn --}}
                                    <td>
                                        <a href="{{ URL::to('/view-borrow-tthl-detail/' . $list_borrow->borrow_tthl_id) }}"
                                            class="action-icon text-success" title="Xem chi tiết"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ URL::to('/edit-borrow-tthl/' . $list_borrow->borrow_tthl_id) }}"
                                            title="sửa" class="action-icon text-success"> <i
                                                class="mdi mdi-square-edit-outline"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"
                                            href="{{ URL::to('/delete-borrow-tthl/' . $list_borrow->borrow_tthl_id) }}"
                                            class="action-icon text-danger" title="Xóa"> <i
                                                class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    @endsection
