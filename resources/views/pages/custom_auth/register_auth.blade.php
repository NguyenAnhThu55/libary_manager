<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Manager</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('/public/backend/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('/public/backend/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('/public/backend/css/style.scss')}}">
  <link rel="stylesheet" href="{{asset('/public/backend/css/style.css')}}">
  <!-- fronts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <div class="row">
    <div class="dust-paarticle" style="width:100%">

     
     
      <?php
      $message = Session::get('message');
      if($message){
          echo '<h5 class="alert text-success bg-dark">' . $message . '</h5>';
          session::put('message', null);
      }
      ?>

      <style>
        section{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            
            background: url('public/backend/image/room-interior-design.jpg')no-repeat;
            background-position: center;
            background-size: cover;
        }
        .form-box{
            position: relative;
            width: 400px;
            height: 450px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            display: flex;
            justify-content: center;
            align-items: center;

        }
        h2{
            font-size: 2em;
            color: #000;
            text-align: center;
        }
        .inputbox{
            position: relative;
            margin: 30px 0;
            width: 310px;
            border-bottom: 2px solid #000;
        }
        .inputbox label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #000;
            font-size: 1em;
            pointer-events: none;
            transition: .5s;
        }
        input:focus ~ label,
        input:valid~label{
          top: -15px;
        }

        .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color: #000;
        }
  
        .inputbox ion-icon{
            position: absolute;
            right: 8px;
            color: #000;
            font-size: 1.2em;
            top: 20px;
        }
        .forget{
            margin: -15px 0 15px ;
            font-size: .9em;
            color: #000;
            display: flex;
            justify-content: space-between;  
        }

        .forget label input{
            margin-right: 3px;
            
        }
        .forget label a{
            color: #000;
            text-decoration: none;
        }
        .forget label a:hover{
            text-decoration: underline;
        }
        button{
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }
               
      </style>

      <section>
        <div class="form-box">
            <div class="form-value">
                <form action="{{URL::to('/register-admin')}}" method="POST">
                  @csrf
                    <h2>Đăng Ký</h2>

                    <div class="inputbox">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input id="username" name="admin_name" value="{{old('admin_name')}}" type="text" required>
                        <label for="">Họ và Tên</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input id="email" name="admin_email" value="{{old('admin_email')}}" type="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input id="password" name="admin_password" value="{{old('admin_password')}}" type="password" required>
                        <label for="">Mật Khẩu</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="call-outline"></ion-icon>
                        <input id="phone" name="admin_phone" value="{{old('admin_phone')}}" type="phone" required>
                        <label for="">Số Điện Thoại</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">ghi nhớ  <a href="#">Quên mật khẩu ?</a></label>
                    </div>
                    <button>Đăng Ký</button>
                   
                </form>
            </div>
        </div>
    </section>
     
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="{{asset('/public/backend/javascript/jquery.js')}}"></script>
      <script src="{{asset('/public/backend/javascript/popper.min.js')}}"></script>
      <script src="{{asset('/public/backend/javascript/bootstrap.min.js')}}"></script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

