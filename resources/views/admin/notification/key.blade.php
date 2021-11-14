@extends('admin.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('content')

    <div class="col-md-12">
        <div class="white-box">
            <form action="{{route('notification.key.store')}}" class="form-horizontal" method="post">
                @csrf
                <div class="form-body">
                    <h3 class="box-title">افزودن پارامتر جدید</h3>
                    <hr class="m-t-0 m-b-40">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row {{$errors->has('key') ? 'has-error' : ''}}">
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" name="key" class="form-control" placeholder="پارامتر جدید را اینجا وارد کنید ...">
                                    <span class="help-block"><small>{{$errors->has('key') ? $errors->first('key') : ''}}</small></span>
                                </div>
                                <div class="checkbox checkbox-success" style="margin-top: 8px">
                                    <input id="checkbox34" type="checkbox" name="status">
                                    <label for="checkbox34"> وضعیت</label>
                                </div>
                                <div style="margin-right: 20px">
                                    <button type="submit" class="btn btn-success">ثبت</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="white-box">
            <div class="row">
                <div class="table-responsive">
                    <table id="notification-table" class="table table-striped">
                        <thead>
                        <tr class="headings">
                            <th>#</th>
                            <th>پارامتر</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#notification-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('notification.key.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'key', name: 'key'},
                    {data: 'date', name: 'date'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                language: {
                    url: "{{asset('assets/plugins/datatables/Persion.json')}}"
                },
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>
@stop
