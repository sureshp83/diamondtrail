@extends('layouts.app')
@section('title','Contact-Us')
@section('content')

    <div class="page-content">
        <div id="contact-us">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 vertically-center">
                            <div class="contact-left-section">
                                <div class="animated-circle-block">
                                    <div class="rotating-circle_container">
                                        <svg width="278px" height="69px" viewBox="0 0 427.03 425" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="rotating-circle_border rotating-circle-dark"><path d="M7.77,155.51a212.12,212.12,0,0,0,69,220.2,1.41,1.41,0,0,0,2-.18,1.36,1.36,0,0,0-.18-1.93A209.4,209.4,0,0,1,10.45,156.24a1.35,1.35,0,0,0-.13-1,1.38,1.38,0,0,0-.84-.65,1.4,1.4,0,0,0-1.72,1Z" class="rotating-circle_path rotating-circle_path--1"></path> <path d="M213.51,425C331.25,425,427,329.67,427,212.5a210.62,210.62,0,0,0-37.28-120,1.4,1.4,0,0,0-1.95-.36,1.37,1.37,0,0,0-.58.88,1.35,1.35,0,0,0,.22,1,207.92,207.92,0,0,1,36.8,118.46c0,115.66-94.53,209.75-210.73,209.75A210.35,210.35,0,0,1,95.7,386.43a1.41,1.41,0,0,0-1.94.37,1.35,1.35,0,0,0-.21,1,1.37,1.37,0,0,0,.58.88A213.16,213.16,0,0,0,213.51,425Z" class="rotating-circle_path rotating-circle_path--2"></path> <path d="M93.1,40.34A211.49,211.49,0,0,1,372.75,75.11a1.41,1.41,0,0,0,2,.14,1.36,1.36,0,0,0,.14-1.93A213.92,213.92,0,0,0,14.35,135.75a1.35,1.35,0,0,0,0,1,1.37,1.37,0,0,0,.77.73,1.43,1.43,0,0,0,1.81-.79A209.63,209.63,0,0,1,93.1,40.34Z" class="rotating-circle_path rotating-circle_path--3"></path></svg>
                                    </div>
                                    <div class="animated-circle text-sm-left">
                                        <h1 class="text-capitalize text-sm-left">Get In Touch</h1>
                                        <br>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                        <br>
                                        <p class="contact-address">000 Street Lorem ipsum  <br>City, Postal Code, Country</p>
                                        <p class="contact-phone">514 000 0000</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-xs-12 offset-lg-1 vertically-center">
                            <div class="contact-right-section">
                                <form method="post" name="contactus" action="{{URL::to('contact-us')}}">
                                {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group {{$errors->has('company_name')?' has-error':''}}">
                                                <label role="company_name" class="control-label">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{old('company_name')}}">
                                                @if($errors->has('company_name'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('company_name')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group {{$errors->has('full_name')?' has-error':''}}">
                                                <label class="control-label">Full Name</label>
                                                <input type="text" name="full_name" id="full_name" class="form-control" value="{{old('full_name')}}">
                                                @if($errors->has('full_name'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('full_name')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group {{$errors->has('email')?' has-error':''}}">
                                                <label class="control-label">Email Address</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                                                @if($errors->has('email'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('email')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group {{$errors->has('phone_no')?' has-error':''}}">
                                                <label class="control-label">Phone Number</label>
                                                <input type="tel" name="phone_no" id="phone_no" class="form-control" value="{{old('phone_no')}}" onkeypress="return (event.charCode >=47 && event.charCode<=58)" maxlength="10">
                                                @if($errors->has('phone_no'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('phone_no')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="form-group {{$errors->has('subject')?' has-error':''}}">
                                                <label class="control-label">Subject</label>
                                                <input type="text" name="subject" id="subject" class="form-control" value="{{old('subject')}}">
                                                @if($errors->has('subject'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('subject')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="form-group {{$errors->has('message') ?' has-error':''}}">
                                                <label class="control-label">Your Message</label>
                                                <textarea class="form-control" name="message" id="message" rows="6"></textarea>
                                                @if($errors->has('message'))
                                                <span class="help-block">
                                                	<strong>{{$errors->first('message')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <br>
                                            <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection
