<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Mượn Sách</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="background-color: #222; padding: 20px;">
        <p style="text-align: center; color:crimson;font-weight:bold;font-size:25px">Đây là email tự động vui lòng không trả lời email</p>
        <div class="col-12 col-sm-12 col-md-12" style="background-color: rgb(227, 132, 246); padding: 20px;">
            <div class="row"style="text-align: center; color:#fff;font-weight:bold;font-size:30px">
                <div class="col-6">
                    <h4>Library Manager</h4>
                    <h4>Khoa Phát Triển Nông Thôn - Đại học Cần Thơ</h4>
                </div>
                <div class="col-6">
                    
                </div>
            </div>

            <div class="row"style="color:#fff;font-weight:bold;font-size:30px">
                <div class="col-12">
                    <h5 style="margin-left: 50px;">Chào bạn: <strong>{{$user_array['user_name']}}</strong></h5>
                    <h6 style="margin-left: 50px;font-size: 16px;">
                        Cảm ơn bạn đã quan tâm và sử dụng dịch vụ mượn sách của khoa Email này gửi bạn để 
                        <strong style="background-color: gold; font-size: 16px;">xác nhận bạn đã mượn sách</strong>
                    </h6>
                    <p style="text-align: center; color:rgb(231, 9, 9);font-size:20px">Thông tin Người mượn</p>

                    <h6 style="margin-left: 150px;font-size: 16px;color: black;">Tên Người Mượn: <strong style="color: #fff;">{{$user_array['user_name']}}</strong> </h6>
                    <h6 style="margin-left: 150px;font-size: 16px;color: black;">Số Điện Thoại người mượn:  <strong style="color: #fff;">{{$user_array['user_phone']}}</strong></h6>
                    <h6 style="margin-left: 150px;font-size: 16px;color: black;">email người mượn: <strong style="color: #fff;">{{$user_array['user_email']}}</strong></h6>
                    <h6 style="margin-left: 150px;font-size: 16px;color: black;">Ngày mượn: <strong style="color: #fff;">{{$borrow_pay['created_at']}}</strong></h6>
                    <h6 style="margin-left: 150px;font-size: 16px;color: black;" >Ngày hết hạn mượn: <strong style="color: #fff;background-color: gold;">{{$borrow_pay['pay_day']}}</strong></h6>
                </div>
            </div>

            <div class="row"style="color:#fff;font-weight:bold;font-size:30px">
                <div class="col-12">
                    <h6 style="margin-left: 50px;font-size: 16px;">
                        Bạn vui lòng chú ý đến ngày trả sách đúng hạn, nếu không đúng hạn  
                        <strong style="background-color: gold; font-size: 16px;">có thể bạn sẽ bị phạt tiền</strong>
                    </h6>
                   
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>