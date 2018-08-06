@extends('layouts.app')
@section('title','Register as a buyer & seller')
@section('content')
    <div class="page-content">
    <h1 class="main-title">REGISTER AS BUYER AND SELLER</h1>
    <div class="container">
        <div id="register-as-a-buyer-and-seller">

            <form method="post" name="buyer&seller" action="{{URL::to('register/buyer-seller')}}" id="buyersellerreg" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h2 class="sub-title">Identification</h2>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group {{$errors->has('username') ? ' has-error' :'' }}">
                            <label class="control-label" role="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                            @if($errors->has('username'))
                                <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group {{$errors->has('password') ? ' has-error' :'' }}">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" >
                            @if($errors->has('password'))
                                <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                <hr>
                <br>

                <h2 class="sub-title" >Buyer Account</h2>
                <div class="row" id="buyeraccount">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="company-information">
                            <h2>company information</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_name')? ' has-error':'' }}">
                                        <label for="company_name" class="control-label">Company Name</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name" value="{{old('company_name')}}">
                                        @if($errors->has('comapny_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('comapny_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_address_1')? ' has-error':'' }}">
                                        <label for="company_address_1" class="control-label">Company Address</label>
                                        <input type="text" class="form-control" name="company_address_1" id="company_address_1" value="{{old('company_address_1')}}" style="margin-bottom: 12px">
                                        @if($errors->has('company_address_1'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('company_address_1')}}</strong>
                                            </span>
                                        @endif
                                        <input type="text" class="form-control " name="company_address_2" id="company_address_2" value="{{old('company_address_1')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('city')? ' has-error':'' }}">
                                        <label for="city" class="control-label">City</label>
                                        <input type="text" class="form-control" name="city" id="city" value="{{old('city')}}">
                                        @if($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('city')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('country_id')?' has-error':''}}">
                                        <label class="control-label" for="country_id">Country</label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="" selected>Please Select</option>
                                            @foreach($countries as $key => $country)
                                                <option value="{{$country->id}}">{{$country->abbreviation}}</option>
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
                                    <div class="form-group {{$errors->has('province_id')?' has-error':''}}">
                                        <label class="control-label" for="province_id">Province/State</label>
                                        <select name="province_id" id="province_id" class="form-control">
                                            <option value="" selected>Please Select</option>
                                        </select>
                                        @if($errors->has('province_id'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('province_id')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('postal_code')?' has-error':''}}">
                                        <label class="control-label" for="postal_code">Postal Code</label>
                                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{old('postal_code')}}">
                                        @if($errors->has('postal_code'))
                                            <span class="help-block"><strong>{{$errors->first('postal_code')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_phone')? 'has-error':''}}">
                                        <label class="control-label" role="company_phone">Company Phone Number</label>
                                        <input type="tel" name="company_phone" id="company_phone" class="form-control" value="{{old('company_phone')}}" maxlength="10" onkeypress="return (event.charCode>=47 && event.charCode<=58)">
                                        @if($errors->has('company_phone'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('company_phone')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company website</label>
                                        <input type="url" name="company_web" id="company_web" class="form-control form-group" value="{{old('company_web')}}" placeholder="http://www.yourwebsitehere.com">
                                        <select name="type_of_company" name="type_of_company" id="type_of_company" class="form-control">
                                            <option value="">Type of Company</option>
                                            @foreach($company_type as $key => $comp)
                                                @if (old('type_of_company') == $comp->id)
                                                    <option value="{{ $comp->id }}" selected>{{ $comp->name }}</option>
                                                @else
                                                    <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 othertypecomp" style="display:<?php echo (old('type_of_company') == 6)?'block':'none';?>">
                                    <div class="form-group">
                                        <label>Other Type of Company </label>
                                        <input type="text" name="other_type" id="other_type" class="form-control" value="{{old('other_type')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="contact-person">
                            <h2>Contact Person</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('first_name')? 'has-error' : ''}}">
                                        <label for="first_name" class="control-label">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{old('first_name')}}">
                                        @if($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('first_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('last_name')? 'has-error' : ''}}">
                                        <label for="last_name" class="control-label">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name')}}">
                                        @if($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('last_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('email')? 'has-error' : ''}}">
                                        <label for="email" class="control-label">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                                        @if($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('email')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company position</label>
                                        <input type="text" name="position" id="position" class="form-control" value="{{old('position')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="company-documentation">
                            <h2>Company Documentation</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Certificate of Incorporation</label><br>
                                        <label class="custom-file-label" for="incorporation_certificate">UPLOAD PDF</label>
                                                <input type="file" name="incorporation_certificate" class="custom-file-input" id="incorporation_certificate" accept=".pdf">

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Memorandum and Articles of Association</label><br>
                                        <label class="custom-file-label" for="memorandom_certificate">UPLOAD PDF</label>
                                                <input type="file" name="memorandom_certificate" class="custom-file-input" id="memorandom_certificate" accept=".pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <hr>
                <br>

                <h2 class="sub-title" >Seller Account</h2>
                <div class="row" id="selleraccount">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <input type="hidden" name="same-info" value="">
                        <input type="checkbox" tabindex="1" class="form-control radio-input" id="same-info" name="same-info">
                        <label class="radio-btn" for="same-info">I want to use the same information as the Buyer account</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="company-information">
                            <h2>company information</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('s_company_name')? ' has-error':'' }}">
                                        <label class="control-label" for="s_company_name">Company Name</label>
                                        <input type="text" class="form-control" name="s_company_name" id="s_company_name" value="{{old('s_company_name')}}">
                                        @if($errors->has('s_company_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('s_company_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('s_company_address_1')? ' has-error':'' }}">
                                        <label class="control-label" for="s_company_address_1">Company Address</label>
                                        <input type="text" class="form-control" name="s_company_address_1" id="s_company_address_1" value="{{old('s_company_address_1')}}" style="margin-bottom: 12px">
                                        @if($errors->has('s_company_address_1'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('s_company_address_1')}}</strong>
                                            </span>
                                        @endif
                                        <input type="text" class="form-control " name="s_company_address_2" id="s_company_address_2" value="{{old('s_company_address_2')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('s_city')? ' has-error':'' }}">
                                        <label for="s_city" class="control-label">City</label>
                                        <input type="text" class="form-control" name="s_city" id="s_city" value="{{old('s_city')}}">
                                        @if($errors->has('s_city'))
                                            <span class="help-block"><strong>{{$errors->first('s_city')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" for="s_country_id">Country</label>
                                        <select name="s_country_id" id="s_country_id" class="form-control">
                                            <option value="" selected>Please Select</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->abbreviation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" for="s_province_id">Province/State</label>
                                        <select name="s_province_id" id="s_province_id" class="form-control">
                                            <option value="" selected>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('s_postal_code')? ' has-error' : ''}}">
                                        <label class="control-label" for="s_postal_code">Postal Code</label>
                                        <input type="text" class="form-control" name="s_postal_code" id="s_postal_code" value="{{old('s_postal_code')}}">
                                        @if($errors->has('s_postal_code'))
                                            <span class="help-block"><strong>{{$errors->first('s_postal_code')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('s_company_phone')? ' has-error':'' }}">
                                        <label for="s_company_phone" class="control-label">Company Phone Number</label>
                                        <input type="tel" class="form-control" name="s_company_phone" id="s_company_phone" value="{{old('s_company_phone')}}" maxlength="10" onkeypress="return (event.charCode>=47 && event.charCode<=58)">
                                        @if($errors->has('s_company_phone'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('s_company_phone')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company website</label>
                                        <input type="url" id="s_company_web" name="s_company_web" class="form-control form-group" value="{{old('s_company_web')}}" placeholder="http://www.yourwebsitehere.com">
                                        <select name="s_type_of_company" id="s_type_of_company" class="form-control">
                                            <option value="">Type of Company</option>
                                            @foreach($company_type as $key => $comp)
                                                @if (old('type_of_company') == $comp->id)
                                                    <option value="{{ $comp->id }}" selected>{{ $comp->name }}</option>
                                                @else
                                                    <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group sothertypecomp" style="display:<?php echo (old('s_type_of_company') == 6)?'block':'none';?>">
                                        <label>Other type of company</label>
                                        <input type="text" class="form-control" name="s_other_type" id="s_other_type" value="{{old('s_other_type')}}">
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
                                    <div class="form-group {{$errors->has('s_username')? ' has-error':'' }}">
                                        <label class="control-label" for="s_username">Username</label>
                                        <input type="text" class="form-control" name="s_username" id="s_username" value="{{old('s_username')}}">
                                        @if($errors->has('s_username'))
                                            <span class="help-block"><strong>{{$errors->first('s_username')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('s_password')? 'has-error' : ''}}">
                                        <label for="s_password" class="control-label">Password</label>
                                        <input type="password" class="form-control" name="s_password" id="s_password" value="{{old('s_password')}}">
                                        @if($errors->has('s_password'))
                                            <span class="help-block"><strong>{{$errors->first('s_password')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-person">
                            <h2>Contact Person</h2>
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{$errors->has('s_first_name')? 'has-error' : ''}}">
                                    <label for="s_first_name" class="control-label">First Name</label>
                                    <input type="text" name="s_first_name" id="s_first_name" class="form-control" value="{{old('s_first_name')}}">
                                    @if($errors->has('s_first_name'))
                                        <span class="help-block">
                                                <strong>{{$errors->first('s_first_name')}}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{$errors->has('s_last_name')? 'has-error' : ''}}">
                                    <label for="s_last_name" class="control-label">Last Name</label>
                                    <input type="text" name="s_last_name" id="s_last_name" class="form-control" value="{{old('s_last_name')}}">
                                    @if($errors->has('s_last_name'))
                                        <span class="help-block">
                                                <strong>{{$errors->first('s_last_name')}}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group {{$errors->has('s_email')? 'has-error' : ''}}">
                                    <label for="s_email" class="control-label">Email Address</label>
                                    <input type="email" name="s_email" class="form-control" id="s_email" value="{{old('e_email')}}">
                                    @if($errors->has('s_email'))
                                        <span class="help-block">
                                                <strong>{{$errors->first('s_email')}}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Company position</label>
                                    <input type="text" name="s_position" id="s_position" class="form-control" value="{{old('s_position')}}">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="company-documentation">
                            <h2>Company Documentation</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Certificate of Incorporation</label><br>
                                        <label class="custom-file-label" for="s_incorporation_certificate">UPLOAD PDF</label>
                                                <input type="file" name="s_incorporation_certificate" class="custom-file-input" id="s_incorporation_certificate" accept=".pdf">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Memorandum and Articles of Association</label><br>
                                        <label class="custom-file-label" for="s_memorandom_certificate">UPLOAD PDF</label>
                                                <input type="file" name="s_memorandom_certificate" class="custom-file-input" id="s_memorandom_certificate" accept=".pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accreditation">
                            <h2>Accreditation</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>RLC Certificate</label><br>
                                        <label class="custom-file-label" for="acc_rlc_certificate">UPLOAD PDF</label>
                                                <input type="file" name="acc_rlc_certificate" class="custom-file-input" id="acc_rlc_certificate" accept=".pdf">

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Provenance Claim</label><br>
                                        <label class="custom-file-label" for="acc_prov_certificate">UPLOAD PDF</label>
                                                <input type="file" name="acc_prov_certificate" class="custom-file-input" id="acc_prov_certificate" accept=".pdf">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row radio-confirm">
                    <div class="col-lg-5 col-md-12 col-xs-12 offset-lg-6">
                        <input type="checkbox" class="form-control radio-input" id="terms-condition">
                        <label class="radio-btn" for="terms-condition">I agree to the terms of the T&Cs.</label>
                        <br>
                        <br>
                        <input type="button" class="btn btn-primary disabled" value="register"  id="register_btn" name="register">
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
@endsection