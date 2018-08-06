@extends('adminlte::layouts.app')
@section('contentheader_title','Edit Profile')
@section('main-content')

<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" name="adminedituser" action="{{URL::to('admin/profile')}}" enctype="multipart/form-data">
{{csrf_field()}}
<div class="box-header with-border">
     <h3 class="box-title">User Detail</h3>
</div>
<div class="box-body">
	
	<div class="row">	
	  <div class="col-md-4 col-sm-6 col-lg-4">
		<div class="form-group">
            <label class="control-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{$admin[0]['username']}}">
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-lg-4">
		<div class="form-group">
            <label class="control-label">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{$admin[0]['first_name']}}">
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-lg-4">
		<div class="form-group">
            <label class="control-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{$admin[0]['last_name']}}">
        </div>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-4 col-sm-6 col-lg-4">
		<div class="form-group">
            <label class="control-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{$admin[0]['email']}}">
        </div>
      </div>	
      <div class="col-md-4 col-sm-6 col-lg-4">
		  <div class="form-group">
            <label class="control-label">Password</label>
                <input type="text" class="form-control" name="password" value="{{$admin[0]['password_string']}}">
        </div>
      </div>	
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-lg-4">
        <div class="form-group">
                <label class="control-label">Profile</label>
                    <input type="file" class="form-control" name="profile_pic" value="">
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-lg-4">
        <img src="{{asset('images/')}}/{{$admin[0]['profile_pic']}}" id="adminprofilepic" />
      </div>  
    </div>

    <hr>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="row">
       <div class="col-md-2 col-sm-6 col-lg-2">
        <a href="{{URL::to('admin/dashboard')}}" class="btn btn-block btn-default">Back</a>
       </div>
       <div class="col-md-2 col-sm-6 col-lg-2">
        <button type="submit" class="btn btn-block btn-primary">Save</button>
       </div>
       </div>  
      </div>
    </div>
</div>
</form>
</div>       
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#adminprofilepic').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("input[type=file][name='profile_pic']").change(function() {
  readURL(this);
});
</script>
@endsection