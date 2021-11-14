@extends('admin.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('content')

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="table-responsive">
                        <table id="vcard-table" class="table table-striped">
                            <thead>
                            <tr class="headings">
                                <th>#</th>
                                <th>تصویر</th>
                                <th>کاربر</th>
                                <th>عنوان</th>
                                <th>ریپورتر</th>
                                <th>دلیل</th>
                                <th>عصبانیت</th>
                                <th>تاریخ</th>
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
            $('#vcard-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('report.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'user', name: 'user'},
                    {data: 'title', name: 'title'},
                    {data: 'userR', name: 'userR'},
                    {data: 'reason', name: 'reason'},
                    {data: 'anger', name: 'anger'},
                    {data: 'date', name: 'date'},
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
