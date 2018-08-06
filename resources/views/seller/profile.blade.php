@extends('layouts.app')
@section('title','Profile')
@section('content')
 <div class="page-content">
    <div class="container">
        <div id="my-account">
            <h2 class="sub-title text-sm-left">My Account</h2>
            <form method="post" action="{{URL::to('seller/myaccount')}}" autocomplete="off" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{$userdetail->id}}">
                <input type="hidden" name="comp_id" value="{{$userdetail->profiles->id}}">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="company-information">
                            <h2>company information</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="control-label">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" value="{{$userdetail->profiles->company_name}}">
                                        @if($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('company_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_address_1')? 'has-error' : ''}}">
                                        <label class="control-label" for="company_address_1">Company Address</label>
                                        <input type="text" name="company_address_1" id="company_address_1" class="form-control form-group" value="{{$userdetail->profiles->company_address_1}}" >
                                        @if($errors->has('company_address_1'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('company_address_1')}}</strong>
                                            </span>
                                        @endif
                                        <input type="text" class="form-control" name="company_address_2" id="company_address_2" value="{{$userdetail->profiles->company_address_2}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('city')? 'has-error' : ''}}">
                                        <label for="city" class="control-label">City</label>
                                        <input type="text" name="city" id="city" class="form-control" value="{{$userdetail->profiles->city}}">
                                        @if($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('city')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('country_id')?' has-error' :''}}">
                                        <label for="country_id" class="control-label">Country</label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            @foreach($countries as $key => $country)
                                                @if($userdetail->profiles->country_id == $country->id)
                                                    <option value="{{$country->id}}" selected>{{$country->abbreviation}}</option>
                                                @else
                                                    <option value="{{$country->id}}">{{$country->abbreviation}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('country_id'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('country_id')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('province_id') ? 'has-error' : ''}}">
                                        <label class="control-label" for="province_id">Province/State</label>
                                        <select name="province_id" id="province_id" class="form-control" data-value="{{$userdetail->profiles->province_id}}">
                                            @foreach($province as $key => $prov)
                                                @if($userdetail->profiles->province_id == $prov->id)
                                                    <option value="{{$prov->id}}" selected>{{$prov->name}}</option>
                                                @else
                                                    <option value="{{$prov->id}}">{{$prov->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('province_id'))
                                            <span class="help-block"><strong>{{$errors->first('province_id')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('postal_code') ?' has-error' :''}}">
                                        <label class="control-label" for="postal_code">Zip/Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code"  id="postal_code" value="{{$userdetail->profiles->postal_code}}">
                                        @if($errors->has('postal_code'))
                                            <span class="help-block"><strong>{{$errors->first('postal_code')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('company_phone') ? 'has-error' :''}}">
                                        <label class="control-label" for="company_phone">Company Phone Number</label>
                                        <input type="tel" class="form-control" name="company_phone" id="company_phone" value="{{$userdetail->profiles->company_phone}}" maxlength="10" onkeypress="return (event.charCode>=47 && event.charCode<=58)">
                                        @if($errors->has('company_phone'))
                                            <span class="help-block"><strong>{{$errors->first('company_phone')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Company website</label>
                                        <input type="url" class="form-control form-group" value="{{$userdetail->profiles->company_web}}" placeholder="http://www.yourwebsitehere.com">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Type of Company</label>
                                        <select name="type_of_company" class="form-control" id="type_of_company">
                                            <option value="">Type of Company</option>
                                            @foreach($company_type as $key => $comp)
                                                @if ($userdetail->profiles->type_of_company == $comp->id)
                                                    <option value="{{ $comp->id }}" selected>{{ $comp->name }}</option>
                                                @else
                                                    <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 othertypecomp" style="display:<?php echo ($userdetail->profiles->type_of_company == 6)?'block':'none';?>">
                                    <div class="form-group">
                                        <label>Other Type of Company </label>
                                        <input type="text" name="other_type" class="form-control" value="{{$userdetail->profiles->other_typeof_company}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="identification">
                            <h2>Identification</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <p class="user-name-disabled">{{$userdetail->username}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <a class="btn btn-inverse text-uppercase" href="{{URL::to('/seller/reset-password')}}">Reset Your Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-person">
                            <h2>Contact Person</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('first_name') ? ' has-error' :''}}">
                                        <label class="control-label" for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{$userdetail->first_name}}">
                                        @if($errors->has('first_name'))
                                            <span class="help-block"><strong>{{$errors->first('first_name')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('last_name') ? ' has-error' :''}}">
                                        <label class="control-label" for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{$userdetail->last_name}}">
                                        @if($errors->has('last_name'))
                                            <span class="help-block"><strong>{{$errors->first('last_name')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company position</label>
                                        <input type="text" class="form-control" value="{{$userdetail->position}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('email') ? ' has-error' :''}}">
                                        <label class="control-label" for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$userdetail->email}}">
                                        @if($errors->has('email'))
                                            <span class="help-block"><strong>{{$errors->first('email')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="company-documentation">
                            <h2>Company Documentation</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Certificate of Incorporation</label>
                                        {{--<p class="uploaded-file"></p>--}}
                                        @if($userdetail->profiles->incorporation_certificate)
                                            {{--<p class="uploaded-file"></p>--}}
                                            <input type="hidden" name="incorporation_certificate" class="filedata" id="incorporation_certificate" value="{{$userdetail->profiles->incorporation_certificate}}">
                                            <a href="javascript:void(0);" class="uploaded-file" {{--class="remove-file"--}}>{{$userdetail->profiles->incorporation_certificate}}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Memorandum and Articles of Association</label>
                                        {{--<p class="uploaded-file"></p>--}}
                                        @if($userdetail->profiles->memorandom_certificate)
                                            {{--<p class="uploaded-file"></p>--}}
                                            <input type="hidden" name="memorandom_certificate" class="filedata" id="memorandom_certificate" value="{{$userdetail->profiles->memorandom_certificate}}">
                                            <a href="javascript:void(0);" class="uploaded-file" {{--class="remove-file"--}}>{{$userdetail->profiles->memorandom_certificate}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accreditation">
                            <h2>Accreditation</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>RLC Certificate</label>
                                        {{--<p class="uploaded-file"></p>--}}
                                        @if($userdetail->profiles->acc_rlc_certificate)
                                            {{--<p class="uploaded-file"></p>--}}
                                            <input type="hidden" name="acc_rlc_certificate" class="filedata" id="acc_rlc_certificate" value="{{$userdetail->profiles->acc_rlc_certificate}}">
                                            <a href="javascript:void(0);" class="uploaded-file" {{--class="remove-file"--}}>{{$userdetail->profiles->acc_rlc_certificate}}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Provenance Claim</label>
                                        {{--<p class="uploaded-file"></p>--}}
                                        @if($userdetail->profiles->acc_prov_certificate)
                                            {{--<p class="uploaded-file"></p>--}}
                                            <input type="hidden" name="acc_prov_certificate" class="filedata" id="acc_prov_certificate" value="{{$userdetail->profiles->acc_prov_certificate}}">
                                            <a href="javsacript:void(0);" class="uploaded-file" {{--class="remove-file"--}}>{{$userdetail->profiles->acc_prov_certificate}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <hr>

                <div class="row bottom-btns">
                
                <div class="col-lg-6 col-md-6 col-xs-12">
                    @if(!(Auth::user()->roles[0]->name=='Buyer And Seller'))
                            <input type="button" class="btn btn-inverse" value="become a Buyer" name="become_a_buyer" id="become_a_buyer">
                    @endif        
                </div>
                
                    
                    <div class="col-lg-6 col-md-6 col-xs-12 text-sm-right">
                        <!-- <input type="button" class="btn btn-primary disabled" value="Edit" name="edit"> -->
                        <input type="submit" class="btn btn-primary" value="Save" name="save">
                    </div>
                </div>

            </form>
        </div>
    </div>
 </div>
 <div id="custom-alert-box">
 <form method="post" action="{{URL::to('seller/becomebuyer')}}">
 {{csrf_field()}}
        <div class="alert-box text-sm-center">
            <h3>Are you sure <br>
                you want become a buyer ?</h3>
            <a href="javascript:void(0);" onclick="closeAlert()" class="btn btn-inverse">Cancel</a>
            <button type="submit" class="btn btn-primary becameBuyer">BECOME A BUYER</button>
        </div>
 </form>       
    </div>

<script type="text/javascript">
    $("#become_a_buyer").on("click",function(){
        $("#custom-alert-box").show();
        setTimeout(function () {
            $('#custom-alert-box .alert-box').addClass('show-alert');
        }, 100);
    });
</script>
@endsection