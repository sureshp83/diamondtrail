@extends('adminlte::layouts.app')
@section('contentheader_title','Edit User')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" name="adminedituser" action="{{URL::to('/admin/users/edit')}}/{{$userdetail[0]->id}}" enctype="multipart/form-data">
{{csrf_field()}}
<input type="hidden" name="back_url" value="{{$back_url}}">
<div class="box-header with-border">
     <h3 class="box-title">User Detail</h3>
</div>
<div class="box-body">
	
	<div class="row">	
	  <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">User Id</label>
                <input type="text" class="form-control" name="user_id" value="{{$userdetail[0]->id}}" readonly="">
        </div>
      </div> 
      <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{$userdetail[0]->username}}" readonly="">
        </div>
      </div>   
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{$userdetail[0]->email}}" readonly="">
        </div>
      </div> 
	  <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$userdetail[0]->first_name}}">
        </div>
      </div> 
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$userdetail[0]->last_name}}">
        </div>
      </div> 
      <div class="col-md-6 col-sm-6 col-lg-6">
		<!-- radio -->

              <div class="form-group">
              <label class="control-label">Status</label>
              <div>
                <label>
                  <input type="radio" name="status" class="flat-red" value="Active" {{($userdetail[0]->status == 'Active')?'checked':''}}>&nbsp;&nbsp;  Active
                </label>&nbsp;&nbsp;
                <label>
                  <input type="radio" name="status" class="flat-red" value="Suspend" {{($userdetail[0]->status == 'Suspend')?'checked':''}}>&nbsp;&nbsp; Suspend
                </label>&nbsp;&nbsp;
                <label>
                  <input type="radio" name="status" class="flat-red" value="Uncomplete" {{($userdetail[0]->status == 'Uncomplete')?'checked':''}}>&nbsp;&nbsp; Uncomplete
                </label>
              </div>
            </div>
      </div> 
    </div>  

</div>
<div class="box-header with-border">
     <h3 class="box-title">Company Detail</h3>
</div>

<div class="box-body">
	
	<div class="row">	
		<div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">Company Id</label>
                <input type="text" class="form-control" name="comp_id" value="{{$userdetail[0]->profiles->id}}" readonly="">
        </div>
      </div> 
      <div class="col-md-3 col-sm-3 col-lg-3"></div>
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Company Name</label>
                <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{$userdetail[0]->profiles->company_name}}">
        </div>
      </div> 
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Company Address 1</label>
                <input type="text" class="form-control" placeholder="Company Address 1" name="company_address_1" value="{{$userdetail[0]->profiles->company_address_1}}">
        </div>
      </div> 
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Company Address 2</label>
                <input type="text" class="form-control" placeholder="Company Address 2" name="company_address_2" value="{{$userdetail[0]->profiles->company_address_2}}">
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
		  <label for="country_id" class="control-label">Country</label>
		  <select name="country_id" id="country_id" class="form-control">
            @foreach($countries as $key => $country)
                @if($userdetail[0]->profiles->country_id == $country->id)
                    <option value="{{$country->id}}" selected>{{$country->abbreviation}}</option>
                @else
                    <option value="{{$country->id}}">{{$country->abbreviation}}</option>
                @endif
            @endforeach
        </select>
		</div>
	  </div>	

	  <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
		  <label for="province_id" class="control-label">Province</label>
		  <select name="province_id" id="province_id" class="form-control" data-value="{{$userdetail[0]->profiles->province_id}}">
                @foreach($province as $key => $prov)
                    @if($userdetail[0]->profiles->province_id == $prov->id)
                        <option value="{{$prov->id}}" selected>{{$prov->name}}</option>
                    @else
                        <option value="{{$prov->id}}">{{$prov->name}}</option>
                    @endif
                @endforeach
            </select>
		</div>
	  </div>	

	  <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
		  <label for="city" class="control-label">City</label>	
		  <input type="text" class="form-control" name="city"  id="city" value="{{$userdetail[0]->profiles->city}}">
		</div>
	  </div>	

	  <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
			<label for="postal_code" class="control-label">Zip/Postal Code</label>
			<input type="text" class="form-control" name="postal_code"  id="postal_code" value="{{$userdetail[0]->profiles->postal_code}}">
		</div>
	  </div>	

      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Company Phone</label>
                <input type="text" class="form-control" placeholder="Company Phone" name="company_phone" value="{{$userdetail[0]->profiles->company_phone}}">
        </div>
      </div> 
      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
            <label class="control-label">Company Web</label>
                <input type="text" class="form-control" placeholder="Company Web" name="company_web" value="{{$userdetail[0]->profiles->company_web}}">
        </div>
      </div> 

      <div class="col-md-6 col-sm-6 col-lg-6">
		<div class="form-group">
		   <label class="control-label">Type of Company</label>
            <select name="type_of_company" id="type_of_company" class="form-control">
                <option value="">Type of Company</option>
                @foreach($company_type as $key => $comp)
                    @if ($userdetail[0]->profiles->type_of_company == $comp->id)
                        <option value="{{ $comp->id }}" selected>{{ $comp->name }}</option>
                    @else
                        <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6">
      	<div class="form-group">
      		<div class="othertypecomp" style="display:<?php echo ($userdetail[0]->profiles->type_of_company == 6)?'block':'none';?>">
                <div class="form-group">
                    <label>Other Type of Company </label>
                    <input type="text" name="other_type" class="form-control" value="{{$userdetail[0]->profiles->other_typeof_company}}">
                </div>
            </div>	
      	</div>
      </div>
	</div>
</div>
<div class="box-header with-border">
     <h3 class="box-title">Company Documentation</h3>
</div>
<div class="box-body">
	
	<div class="row">	
	  <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">Certificate of Incorporation</label>
                <input type="file" class="form-control" name="incorporation_certificate" id="incorporation_certificate" data-value="{{$userdetail[0]->profiles->incorporation_certificate}}" accept=".pdf" >
                <a href="javascript:void(0);" onclick="deleteCertificateFile()" id="remove-file-inc" class="remove-file">{{$userdetail[0]->profiles->incorporation_certificate}}</a>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">Memorandum and Articles of Association</label>
                <input type="file" class="form-control" name="memorandom_certificate" id="memorandom_certificate" data-value="{{$userdetail[0]->profiles->memorandom_certificate}}" accept=".pdf" >
                <a href="javascript:void(0);" onclick="deleteMemCertificateFile()" id="remove-file-mem" class="remove-file">{{$userdetail[0]->profiles->memorandom_certificate}}</a>
                
        </div>
      </div>
      @if(isset($userdetail[0]->profiles->acc_rlc_certificate))
      <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">RLC Certificate</label>
                <input type="file" class="form-control" name="acc_rlc_certificate" id="acc_rlc_certificate" data-value="{{$userdetail[0]->profiles->acc_rlc_certificate}}" accept=".pdf" >
                <a href="javascript:void(0);" onclick="deleteAccRlcCertificate()" id="remove-file-acc_rlc" class="remove-file">{{$userdetail[0]->profiles->acc_rlc_certificate}}</a>
        </div>
      </div>
      @endif
      @if(isset($userdetail[0]->profiles->acc_prov_certificate))
      <div class="col-md-3 col-sm-3 col-lg-3">
		<div class="form-group">
            <label class="control-label">Provenance Claim</label>
                <input type="file" class="form-control" name="acc_prov_certificate" id="acc_prov_certificate" data-value="{{$userdetail[0]->profiles->acc_prov_certificate}}" accept=".pdf" >
                <a href="javascript:void(0);" onclick="deleteAccProvCertificate()" id="remove-file-acc_prov" class="remove-file">{{$userdetail[0]->profiles->acc_prov_certificate}}</a>
        </div>
      </div>
      @endif
      <div class="col-md-12 col-sm-12 col-lg-12">
      	<div class="row">
      		<div class="col-md-2 col-sm-6 col-lg-2">
      			<a href="{{URL::to('admin')}}/{{$back_url}}" class="btn btn-block btn-default">Back</a>
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
<script type="text/javascript">
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });


</script>
@endsection