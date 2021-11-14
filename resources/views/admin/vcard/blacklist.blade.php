@extends('admin.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('content')

    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="table-responsive">
                    <table id="vcard-black-table" class="table table-striped">
                        <thead>
                        <tr class="headings">
                            <th>#</th>
                            <th>تصویر</th>
                            <th>کاربر</th>
                            <th>عنوان</th>
                            <th>تخصص</th>
                            <th>بازدید</th>
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
            $('#vcard-black-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('vcard.datatable', ['type' => 'black']) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'user', name: 'user'},
                    {data: 'title', name: 'title'},
                    {data: 'specialty', name: 'specialty'},
                    {data: 'view_count', name: 'view_count'},
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
