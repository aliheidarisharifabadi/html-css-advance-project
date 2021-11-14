@extends('errors.app')

@section('content')

    <h1>500</h1>
    <h3 class="text-uppercase">با عرض پوزش، در سرورهای ما خطایی رخ داده است!</h3>
    <a href="{{route('welcome')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">بازگشت به خانه</a>

@stop
