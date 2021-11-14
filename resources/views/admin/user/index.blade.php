@extends('admin.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('content')

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="table-responsive">
                        <table id="user-table" class="table table-striped">
                            <thead>
                            <tr class="headings">
                                <th>#</th>
                                <th>تصویر</th>
                                <th>نام کامل</th>
                                <th>شماره همراه</th>
                                <th>معرف</th>
                                <th>ثبت کارت</th>
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
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('user.datatable', ['type' => 'white']) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'phone', name: 'phone'},
                    {data: 'ref', name: 'ref'},
                    {data: 'vStatus', name: 'vStatus'},
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
