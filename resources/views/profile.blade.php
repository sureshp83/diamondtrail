@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="my-account">
            <h2 class="sub-title text-sm-left">My Account</h2>
            <form autocomplete="off">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="company-information">
                            <h2>company information</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" value="{{$userdetail->profiles->company_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company Address</label>
                                        <input type="text" class="form-control form-group" value="{{$userdetail->profiles->company_address_1}}" >
                                        <input type="text" class="form-control" value="{{$userdetail->profiles->company_address_2}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" value="{{$userdetail->profiles->city}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->abbreviation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Province/State</label>
                                        <select class="form-control">
                                            <option>Quebec</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" class="form-control" value="{{$userdetail->profiles->postal_code}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company Phone Number</label>
                                        <input type="tel" class="form-control" value="{{$userdetail->profiles->company_phone}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company website</label>
                                        <input type="url" class="form-control form-group" value="{{$userdetail->profiles->company_web}}">
                                        <select class="form-control">
                                            <option></option>
                                        </select>
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
                                        <a class="btn btn-inverse text-uppercase" href="#">Reset Your Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-person">
                            <h2>Contact Person</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="{{$userdetail->first_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="{{$userdetail->last_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" value="{{$userdetail->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company position</label>
                                        <input type="text" class="form-control" value="{{$userdetail->position}}">
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
                                        <p class="uploaded-file"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Memorandum and Articles of Association</label>
                                        <p class="uploaded-file"></p>
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
                                        <p class="uploaded-file">RLC_certificate.pdf</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Provenance Claim</label>
                                        <p class="uploaded-file">Provenance_claim.pdf</p>
                                        <p class="uploaded-file"><a href="#" class="remove-file">Provenance_claim.pdf</a></p>
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
                        <input type="submit" class="btn btn-inverse" value="become a Buyer" name="become_a_buyer">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 text-sm-right">
                        <input type="submit" class="btn btn-primary disabled" value="Edit" name="edit">
                        <input type="submit" class="btn btn-primary" value="Save" name="save">
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection