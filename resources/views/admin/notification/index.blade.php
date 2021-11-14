@extends('admin.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('content')

    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="table-responsive">
                    <table id="notification-table" class="table table-striped">
                        <thead>
                        <tr class="headings">
                            <th>#</th>
                            <th>ارسال کننده</th>
                            <th>نوع</th>
                            <th>کلیک شده</th>
                            <th>رسیده شده</th>
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
            $('#notification-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('notification.datatable') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user'},
                    {data: 'type', name: 'type'},
                    {data: 'click_count', name: 'click_count'},
                    {data: 'deliver_count', name: 'deliver_count'},
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
