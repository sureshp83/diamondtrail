@extends('layouts.app')
@section('title','Post diamond')
@section('content')
    <div class="page-content">
        <div id="landing-page">
            <div class="container">
                <div style="height: 60px" class="hide-in-mobile"></div>
                <h2 class="text-sm-center">Lorem ipsum dolor sit amet</h2>
                <p class="text-sm-center">Description lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lobortis convallis mi ac euismod. Nam vestibulum facilisis neque vel aliquet. </p>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-12 offset-lg-2">
                        <div class="register-box text-sm-center">
                            <figure>
                                <img src="{{URL::to('images/single-diamond.png')}}" alt="Post a Diamond" title="Post a Diamond">
                            </figure>
                            <h3>Post a Diamond</h3>
                            <p>Description lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="{{URL::to('seller/pdiamond-step1')}}" class="btn btn-primary">start</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="register-box text-sm-center">
                            <figure>
                                <img src="{{URL::to('images/multiple-diamond.png')}}" alt="Upload Multiple Diamonds" title="Upload Multiple Diamonds">
                            </figure>
                            <h3>Upload Multiple Diamonds</h3>
                            <p>Use our Excel document template to
                                upload multiple diamonds.</p>
                            <a href="{{URL::to('seller/upload-csv-1')}}" class="btn btn-primary">start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection