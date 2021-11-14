<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پرداخت با موفقیت انجام شد</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/assets/temp.css')}}">
</head>
<body container-fluid>
<div dir="rtl" class="content">
    <div class="card text-white bg-success mb-3 success-header">
        <h6 class="h1">
            پرداخت با موفقیت انجام شد
        </h6>
    </div>
    <div class="card-text body">
        کاربر عزیز : {{$user->first_name . ' ' . $user->last_name}}
        <br>
        تعداد {{$point}} امتیاز به اعتبار شما افزوده شد .
        <br>
        کد رهگیری : {{$trackNum}}
    </div>
    <div style="text-align: center" class="card-footer footer">
        <a href="{{$url}}" class="btn btn-success button">بازگشت به سامانه</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>