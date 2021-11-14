@extends('errors.app')

@section('content')

    <h1>401</h1>
    <h3 class="text-uppercase">با عرض پوزش، شما مجاز به دسترسی به این صفحه نیستید!</h3>
    <a href="{{route('welcome')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">بازگشت به خانه</a>

@stop

