@extends('adminlte::layouts.app')
@section('contentheader_title','Diamonds')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Diamonds</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Id</th>
                            <th>Origin</th>
                            <th>Shape</th>
                            <th>Carat</th>
                            <th>Clarity</th>
                            <th>Colour</th>
                            <th>Cut</th>
                            <th>Flou</th>
                            <th>Status</th>
                            <th>Price/Carat($)</th>
                            <th>Total Price($)</th>
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
    <div class="modal modal-danger fade in" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
            <form method="post" action="" id="deletediamondform">
            {{csrf_field()}}
            <input type="hidden" id="dim_id" name="dim_id" value="">
            <input type="hidden" id="user_id" name="user_id" value="">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Diamond</h4>
              </div>
              <div class="modal-body">

                <h4>Are you sure <br>
                you want to delete diamond ?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Delete</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    <script>
        $(function () {

            var table=$('#example1').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'responsive'  : true,
                'ajax': {
                    "url":"{{URL::to('/admin/AjaxDiamondsList')}}/{{Request::Segment(3)}}",
                    "type": "get",
                },
                'columns': [
                    { "data": "created_at" },
                    { "data": "id"},
                    { "data": "origin"},
                    { "data": "shape_label"},
                    { "data": "carat"},
                    { "data": "clarity_type_label"},
                    { "data": "color_label"},
                    { "data": "cut_type_label"},
                    { "data": "florescence_type_label"},
                    { "data": "status"},
                    { "data": "price"},
                    { "data": "totalprice"},
                    { "data": null,
                      "className": "center",
                      "defaultContent": '<a href="javascript:void(0);" class="edit_diamond btn btn-primary">Edit</a> <a href="javascript:void(0);" class="delete_diamond btn btn-danger">Delete</a>'
                    },
                ],
            });

            //edit record
             $('#example1').on('click', 'a.edit_diamond', function (e) {
                var row  = $(this).parents('tr')[0];
                var dim_id=table.row( row ).data().id;
                $("a.edit_diamond").attr("href","{{URL::to('admin/edit-diamond')}}/"+dim_id+"");

            } );

            //delete record
             $('#example1').on('click', 'a.delete_diamond', function (e) {
                var row  = $(this).parents('tr')[0];
                var dim_id=table.row( row ).data().id;
                var user_id=window.location.pathname.split('/');

                console.log(user_id);
                $("#deletediamondform").attr("action","{{URL::to('admin/deleteDiamond')}}");
                $("#dim_id").val(dim_id);
                $("#user_id").val(user_id[3]);
                $("#modal-danger").modal('show');
            } ); 
        })

    </script>
@endsection