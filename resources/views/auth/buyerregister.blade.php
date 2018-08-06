@extends('layouts.app')
@section('title','Register as a buyer')
@section('content')
    <div class="page-content">
    <h1 class="main-title">REGISTER AS A BUYER</h1>
    <div class="container">
        <div id="register-as-a-buyer">
            <form method="POST" name="buyerreg" id="buyerreg" action="{{ URL::to('register/buyer') }}" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="company-information">
                            <h2>company information</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="name" class="control-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" autofocus>
                                            @if ($errors->has('company_name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group{{ $errors->has('company_address_1')? ' has-error' : '' }}">
                                        <label for="company_address_1" class="control-label">Company Address</label>
                                        <input type="text" name="company_address_1" class="form-control form-group" value="{{ old('company_address_1') }}">
                                        @if($errors->has('company_address_1'))
                                            <span class="help-block">
                                            <strong>{{$errors->first('company_address_1')}}</strong>
                                            </span>
                                        @endif
                                        <input type="text" name="company_address_2" class="form-control " value="{{old('company_address_2')}}" placeholder="Apartment, Suite, Unit, etc (optional)">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('city')? 'has-error': ''}}">
                                        <label for="city" class="control-label">City</label>
                                        <input type="text" name="city" class="form-control" value="{{old('city')}}">
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
                                            <option value="">Please Select</option>
                                            @foreach($countries as $country)
                                                <option {{ old('country_id') == $country->id ? 'selected' : '' }} value="{{$country->id}}">{{$country->abbreviation}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('country_id'))
                                            <span class="help-block"><strong>{{$errors->first('country_id')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('province_id')? ' has-error':''}}">
                                        <label class="control-label" for="province_id">Province/State</label>
                                        <select name="province_id" id="province_id" class="form-control" data-value="{{old('province_id')}}">
                                            <option value="">Please Select</option>
                                        </select>
                                        @if($errors->has('province_id'))
                                            <span class="help-block"><strong>{{$errors->first('province_id')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('postal_code')? 'has-error':''}}">
                                        <label class="control-label" for="postal_code">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" value="{{old('postal_code')}}">
                                        @if($errors->has('postal_code'))
                                            <span class="help-block"><strong>{{$errors->first('postal_code')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('company_phone')? 'has-error':''}}">
                                        <label class="control-label" role="company_phone">Company Phone Number</label>
                                        <input type="tel" name="company_phone" class="form-control" value="{{old('company_phone')}}" maxlength="10" onkeypress="return (event.charCode>=47 && event.charCode<=58)">
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
                                        <input type="url" name="company_web" class="form-control form-group" value="{{old('company_web')}}" placeholder="http://www.yourwebsitehere.com">
                                        <select name="type_of_company" id="type_of_company" class="form-control">
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
                                        <input type="text" name="other_type" class="form-control" value="{{old('other_type')}}">
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
                                    <input type="hidden" name="usertype" value="Buyer">
                                    <div class="form-group {{$errors->has('username')? 'has-error' : ''}}">
                                        <label class="control-label" for="username">Username</label>
                                        <input type="text" name="username" class="form-control" value="{{old('username')}}">
                                        @if($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('username')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('password')? 'has-error' : ''}}">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" value="">
                                        @if($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('password')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-person">
                            <h2>Contact Person</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('first_name')? 'has-error' : ''}}">
                                        <label class="control-label" for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                                        @if($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('first_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{$errors->has('last_name')? 'has-error' : ''}}">
                                        <label class="control-label" for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                                        @if($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('last_name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{$errors->has('email')? 'has-error' : ''}}">
                                        <label class="control-label" for="email">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
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
                                        <input type="text" name="position" class="form-control" value="{{old('position')}}">
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
                                        <label class="custom-file-label" for="certificate">UPLOAD PDF</label>
                                        <input type="file" name="incorporation_certificate" class="custom-file-input" id="certificate" accept=".pdf">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group file-btn">
                                        <label>Memorandum and Articles of Association</label><br>
                                        <label class="custom-file-label" for="association">UPLOAD PDF</label>
                                                <input type="file" name="memorandom_certificate" class="custom-file-input" id="association" accept=".pdf" data-value="{{old('memorandom_certificate')}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row radio-confirm">
                    <div class="col-lg-5 col-md-12 col-xs-12 offset-lg-6 {{ $errors->has('is_agree') ? ' has-error' : '' }}">
                        {{--<input type="hidden" name="is_agree" value="0">--}}
                        <input type="checkbox" name="is_agree" class="form-control radio-input" id="terms-condition" value="1" tabindex="1">
                        <label class="radio-btn" for="terms-condition">I agree to the terms of the T&Cs.</label>
                        @if($errors->has('is_agree'))
                            <span class="help-block">
                                <strong>{{$errors->first('is_agree')}}</strong>
                            </span>
                        @endif
                        <br>
                        <br>
                        <input type="button" class="btn btn-primary disabled" value="register" id="register_btn" name="register">
                    </div>

                </div>

            </form>
        </div>
    </div>
    </div>
@endsection