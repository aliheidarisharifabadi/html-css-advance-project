<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>#خطا در پرداخت</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/assets/temp.css')}}">
</head>
<body container-fluid >
<div dir="rtl" class="content">
    <div class="card text-white bg-danger mb-3 faill-header">
        <h6 class="h1">
            #خطا در پرداخت
        </h6>
    </div>
    <div class="card-text body">
        پرداخت با خطا مواجه شد.
        <br>
        {{isset($trans) ? $trans : "در صورت کسر وجه از حساب شما طی 72 ساعت آینده مبلغ به حساب شما عودت داده خواهد شد ."}}
        <br>
        در صورت وجود کد رهگیری، آن را به منظور پیگیری های آتی نزد خود نگهدارید.
        <br>
        کد رهگیری : {{$trackNum}}
    </div>
    <div style="text-align: center" class="card-footer footer">
        <a href="{{$url}}" class="btn btn-danger button">بازگشت به سامانه</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>