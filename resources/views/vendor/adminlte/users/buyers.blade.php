@extends('adminlte::layouts.app')
@section('contentheader_title','Buyers')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Buyers</h3>
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
                            <th>Requests</th>
                            <th>Status</th>
                            <th>Reset Password</th>
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
    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reset Password</h4>
              </div>
              <div class="modal-body">
                <!-- <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                    <label class="control-label">Password</label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="form-group">
                            <input type="text" name="old_password" id="old_password" class="form-control" value="" placeholder="Password">
                       </div>
                    </div>
                </div>    -->
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                    <label class="control-label">User Id</label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="form-group">
                            <input type="text" id="p_user_id" class="form-control" name="p_user_id" value="" readonly="">
                            <input type="hidden" id="p_email" name="p_email" value="">
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                    <label class="control-label">New Password</label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="form-group">
                        <input type="password" name="new_password" id="new_password" class="form-control" value="" placeholder="Enter New Password">
                        <span id='pmessage'></span>
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                    <label class="control-label">Confirm Password</label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                      <div class="form-group">
                       <input type="password" name="cnf_password" id="cnf_password" class="form-control" value="" placeholder="Confirm Password">
                       <span id='message'></span>
                       </div>
                    </div>
                </div>   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary savechnages">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
                    "url":"{{URL::to('/admin/AjaxBuyersList')}}",
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
                      "defaultContent": '<a href="javascript:void(0);" class="reset_password">Reset Password</a>'
                    },
                    { "data": null,
                      "className": "center",
                      "defaultContent": '<a href="javascript:void(0);" class="editor_edit btn btn-primary">Edit</a>'
                    }
                ],
            });
            //edit record
             $('#example1').on('click', 'a.editor_edit', function (e) {
                var row  = $(this).parents('tr')[0];
                var user_id=table.row( row ).data().user_id;
                $("a.editor_edit").attr("href","{{URL::to('admin/users/edit/')}}/"+user_id+"");

            } );

            //reset password
             $('#example1').on('click', 'a.reset_password', function (e) {
                var row  = $(this).parents('tr')[0];
                var user_id=table.row( row ).data().user_id;
                var email=table.row( row ).data().email;
                $("#modal-default").modal('show');
                $("#p_user_id").val(user_id);
                $("#p_email").val(email);
                //$("a.reset_password").attr("href","{{URL::to('admin/seller-users/edit/')}}/"+user_id+"");

            } );    

             $('#new_password').on('blur',function(){
                console.log($('#new_password').val().length);
                if($(this).val().length<5){
                $('#pmessage').html('Password must be atleast 6 character long.').css('color', 'red');        
                }else{
                $('#pmessage').html('');    
                }
             });
             $('#cnf_password').on('keyup', function () {
              if ($('#new_password').val() == $('#cnf_password').val()) {
                $('#message').html('Matching').css('color', 'green');
                return true;
              } else 
                $('#message').html('Not Matching').css('color', 'red');
                return false;
            });

            $(".savechnages").on("click",function(){
              if(($('#new_password').val() == $('#cnf_password').val()) && $('#new_password').val().length>5){
                var array={'_token':'{{csrf_token()}}','new_password':$('#new_password').val(),'cnf_password':$('#cnf_password').val(),'p_user_id':$("#p_user_id").val(),'email':$("#p_email").val()};
                  $.ajax({
                    url:"{{URL::to('admin/changeuserpassword')}}",
                    type:"post",
                    data:array,
                    success:function(response){
                        console.log(response);
                        if(response){
                            $("#modal-default").modal('hide');
                            var alhtml='<div class="alert alert-success alert-dismissible">'+
                      '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                      'Password Reset Successfully.!!'+
                      '</div>';
                      $(".content-wrapper").prepend(alhtml);
                        }
                    }
                  });
              }else{
                $('#message').html('Not Matching').css('color', 'red');
                return false;
              }  
            }); 
        })
    </script>
@endsection
