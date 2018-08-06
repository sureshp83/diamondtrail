@extends('adminlte::layouts.app')
@section('contentheader_title','Vendors')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Vendors</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>User Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Posts</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <script>
        $(function () {

            var table=$('#example1').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'ajax': {
                    "url":"{{URL::to('/admin/AjaxVendorsList')}}",
                    "type": "get",
                },
                'columns': [
                    { "data": "created_at" },
                    { "data": "user_id"},
                    { "data": "full_name"},
                    { "data": "email"},
                    { "data": "posts"},
                    { "data": "status"},
                    { "data": null,
                      "className": "center",
                      "defaultContent": '<a href="javascript:void(0);" class="view_diamonds">View Diamonds</a>'
                    },
                ],
            });

            //edit record
             $('#example1').on('click', 'a.view_diamonds', function (e) {
                var row  = $(this).parents('tr')[0];
                var user_id=table.row( row ).data().user_id;
                $("a.view_diamonds").attr("href","{{URL::to('admin/view-diamonds')}}/"+user_id+"");

            } );
        })
    </script>
@endsection
